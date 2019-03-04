<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPayment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $payment;

    protected $service;

    protected $user;

    public function __construct($payment, $service, $user)
    {
        $this->payment = $payment;
        $this->service = $service;
        $this->user = $user;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'icon' => 'credit-card',
            'title' => 'Se ha registrado un nuevo pago',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' ha realizado un pago de  $ ' . number_format($this->payment->amount, 2) .  ', por el concepto
            de '. $this->service->concept .'. Dicho pago fue realizado mediante '. $this->payment->method .', puedes leer más detalles en el menú "Pagos".',
            'route' => route('app.finances.payments.view')
        ];
    }
}
