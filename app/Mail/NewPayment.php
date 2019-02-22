<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $payment;

    protected $service;

    protected $user;

    public function __construct($payment, $service, $user)
    {
        $this->payment = $payment;
        $this->service = $service;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.default')
            ->subject('Pagos')
            ->with([
                'notification' => 'Se ha registrado un nuevo pago',
                'subject' => $this->user->first_name . ' ' . $this->user->last_name . ' ha realizado un pago de  $ ' . number_format($this->payment->amount, 2) .  ', por el concepto
                de '. $this->service->concept .'. Dicho pago fue realizado medinate '. $this->payment->method .'. Puedes leer más detalles en el menú "Pagos" de la plataforma del CONIITCH.',
                'url' => route('app.finances.payments.view')
            ]);
    }
}
