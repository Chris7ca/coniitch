<?php

namespace App\Http\Controllers\Congressman;

use App\Models\Payment;
use App\Models\Service;
use PayPal\Rest\ApiContext;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Notifications\NewPayment;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadVoucher;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use App\Mail\NewPayment as NewPaymentMail;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    

    public function view()
    {    
        return view('app.congressman.payments');
    }

    public function services()
    {
        $roles = Auth()->user()->keyRoles->pluck('key');

        $services = Service::whereHas('for_users', function ($query) use ($roles) {
            $query->whereIn('roles.key', $roles);
        })->with([
            'discount' => function($query){
                $query->where('end_date', '>=', now());
            }
        ])->get();

        $payments = Payment::select(['id','service_id','user_id','status'])
            ->where('user_id', Auth()->user()->id)->get();

        foreach ( $payments as $payment ) {
            $payment->service_id = encode_id($payment->service_id);
        }

        return response()->json(['services' => $services, 'payments' => $payments]);
    }

    public function cart()
    {
        return $cart = ShoppingCart::where('user_id', Auth()->user()->id)
            ->with([
                'service:id,concept,price', 
                'service.discount' => function($query){
                    $query->select(['id','service_id','discount'])->where('end_date', '>=', now());
                }
            ])->get();
    }

    public function addCart(Request $request)
    {
        $item = ShoppingCart::create([
            'user_id' => Auth()->user()->id,
            'service_id' => decode_id($request->service_id)
        ]);

        return $item;
    }

    public function deleteCart($id)
    {
        ShoppingCart::destroy($id);

        return response('Ok', 200);
    }

    public function voucher(UploadVoucher $request, $id)
    {
        $voucher = $request->voucher->store('public/files/vouchers');

        $service = Service::select(['id','concept'])->findOrFail($id);

        $payment = Payment::create([
            'user_id'           => Auth()->user()->id,
            'service_id'        => $id,
            'method'            => $request->method,
            'transaction_id'    => $request->reference,
            'currency_code'     => 'MXN',
            'amount'            => $request->amount,
            'voucher'           => $voucher,
            'required_invoice'  => ($request->invoice) ? 1 : 0
        ]);

        $notifiables_users = getUsersByRole('finances');

        Mail::to('finanzas.coniitch@uaem.mx')->queue(new NewPaymentMail($payment, $service, Auth()->user()));
        Notification::send($notifiables_users, new NewPayment($payment, $service, Auth()->user()));

        $payment['service_id'] = encode_id($payment->service_id);
        $payment['status']     = null;

        return $payment;
    }

}
