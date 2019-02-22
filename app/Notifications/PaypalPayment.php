<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaypalPayment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    protected $payment;

    public function __construct($payment, $user)
    {
        $this->user = $user;
        $this->payment = $payment;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmación de pago')
            ->view(
                'mails.payment', [
                    'user' => $this->user,
                    'payment' => $this->payment    
                ]
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'icon' => 'cedit-card',
            'title' => 'Confirmación de pago',
            'description' => 'Estimado(a) '. $this->user->first_name .' '. $this->user->last_name .', le notificamos que hemos válidado un pago suyo, por una cantidad
            de $ '. $this->payment->transactions[0]->amount->total .'. Puede comprobar el estado de dicho pago así como los conceptos del mimso.
            También le recordamos que los pagos realizados no son reembolsables.',
            'route' => route('app.congressman.payments.view')
        ];
    }
}
