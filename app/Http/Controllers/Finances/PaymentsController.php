<?php

namespace App\Http\Controllers\Finances;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\InvoicingData;
use App\Http\Controllers\Controller;
use App\Notifications\ConfirmationPayment;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:finances');
    }
    
    public function view()
    {
        return view('app.finances.payments');
    }

    public function index()
    {
        $payments = Payment::with([
                'user:id,first_name,last_name',
                'service:id,concept'
            ])->paginate(15);
        
        return $payments;
    }

    public function confirmation($id)
    {
        $payment = Payment::select(['id','user_id','service_id','status'])
            ->with([
                'user:id,first_name,last_name,email',
                'service:id,concept'
            ])
            ->findOrFail($id);

        $payment->status = 1;
        $payment->save();

        Notification::send($payment->user, new ConfirmationPayment($payment->service, $payment->user));

        return response()->json(['message' => 'Confirmación de pago actualizada']);
    }

    public function invoicingData($id)
    {
        return $invoicing_data = InvoicingData::where('user_id', $id)->first();
    }

}
