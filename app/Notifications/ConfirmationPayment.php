<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmationPayment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $service;

    protected $user;
    
    public function __construct($service, $user)
    {
        $this->service = $service;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmación de pago')
            ->view(
                'mails.default', [
                    'notification' => 'Estimado(a) '. $this->user->first_name .' '. $this->user->last_name .',',
                    'subject' => 'Le notificamos que su pago por concepto de '. $this->service->concept .', fue recibido exitosamente y 
                    validado por la coordinación de finanzas mediante la revisión del documento de pago que usted anexó en la plataforma del congreso. También le 
                    recordamos que los pagos realizados no son reembolsables.',
                    'url' => route('app.congressman.payments.view')
                    ]
            );
    }

    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'cedit-card',
            'title' => 'Confirmación de pago',
            'description' => 'Estimado(a) '. $this->user->first_name .' '. $this->user->last_name .', le notificamos que su pago por concepto 
            de '. $this->service->concept .', fue recibido exitosamente y  validado por la coordinación de finanzas mediante la revisión del documento de pago 
            que usted anexó en la plataforma del congreso. También le recordamos que los pagos realizados no son reembolsables.',
            'route' => route('app.congressman.payments.view')
        ];
    }
}
