<?php

namespace App\Http\Controllers;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use App\Notifications\NewPayment;
use App\Notifications\PaypalPayment;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use App\Models\Payment as PaymentModel;
use App\Mail\NewPayment as NewPaymentMail;
use Illuminate\Support\Facades\Notification;

class PaypalController extends Controller
{

    private   $_api_context;

    protected $currency = 'MXN';

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function create()
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $items    = array();
        $subtotal = 0;

        $cart     = ShoppingCart::where('user_id', Auth()->user()->id)
            ->with([
                'service',
                'service.discount' => function($query){
                    $query->select(['id','service_id','discount'])->where('end_date', '>=', now());
                }
            ])->get();

        foreach ( $cart as $itemCart ) {

            $item  = new Item();
            $price = ($itemCart->service->discount) ? ($itemCart->service->price - $itemCart->service->discount->discount) : $itemCart->service->price;

            $item->setName($itemCart->service->concept)
                 ->setCurrency($this->currency)
                 ->setDescription($itemCart->service->description)
                 ->setQuantity(1)
                 ->setSku($itemCart->service->public_id)
                 ->setPrice($price);

            array_push($items, $item);
            $subtotal += $price;

        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        $details = new Details();
        $details->setSubtotal($subtotal);

        $amount = new Amount();
		$amount->setCurrency($this->currency)
			->setTotal($subtotal)
            ->setDetails($details);
            
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('3er Congreso Interacional de Investigación Transdisciplinar en Ciencias Humanas');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('app.congressman.payments.view'))
            ->setCancelUrl(route('app.congressman.payments.view'));

        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
    
        $webProfile = new WebProfile();
        $webProfile->setName('payment-' . uniqid())
            ->setInputFields($inputFields);
    
        $webProfileId = $webProfile->create($this->_api_context)->getId();

        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));

        try {

            $payment->create($this->_api_context);

        } catch (Exception $ex) {

            \Log::info($ex);
            return response($ex, 500);

        }
        
        return $payment;
    }

    public function execute(Request $request)
    {
        $paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        
        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);

        try {

            $result = $payment->execute($execution, $this->_api_context);

            $notifiables_users = getUsersByRole('finances');

            foreach ( $result->transactions[0]->item_list->items as $itemPaid ) {

                $transaction = PaymentModel::create([
                    'user_id'           => Auth()->user()->id,
                    'service_id'        => decode_id($itemPaid->sku),
                    'method'            => ucfirst($result->payer->payment_method),
                    'transaction_id'    => $result->id,
                    'currency_code'     => $result->transactions[0]->amount->currency,
                    'amount'            => $itemPaid->price,
                    'required_invoice'  => ($request->invoice) ? 1 : 0,
                    'status'            => 1,
                ]);

                $transaction->service();

                Mail::to('finanzas.coniitch@uaem.mx')->queue(new NewPaymentMail($transaction, $transaction->service, Auth()->user()));
                Notification::send($notifiables_users, new NewPayment($transaction, $transaction->service, Auth()->user()));
            }

            ShoppingCart::where('user_id', Auth()->user()->id)->delete();

            Notification::send(Auth()->user(), new PaypalPayment($result, Auth()->user()));

        } catch (Exception $ex) {

            return response($ex, 500);

        }

        return $result;
    }

}
