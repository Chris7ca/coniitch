<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ValidateAcademicDocument extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    protected $message;

    protected $accepted = 'Hemos recibido el documento probatorio de su actual estado académico y lo hemos validado, debido
    a ello, le otorgamos un descuento al momento de realizar su pago de inscripción al congreso.
    Acceda al siguiente enlace abriendo esta notificación';

    protected $rejected = 'Hemos recibido el documento probatorio de
    su actual estado académico, lamentablemente no podemos comprobar la válidez del mismo por la siguiente razón: ';
    
    public function __construct($user, $status, $reason)
    {
        $this->user = $user;
        $this->message = ($status) ? $this->accepted : $this->rejected . $reason;
    }

    
    public function via($notifiable)
    {
        return ['mail','database'];
    }


    public function toMail($notifiable)
    {
        $date = $date = now()->formatLocalized('%B %d, %Y');

        return (new MailMessage)
            ->subject('Validación de documentos académicos')
            ->view(
                'mails.default', [
                    'notification' => 'Estimado(a) '. $this->user->first_name .' '. $this->user->last_name .',',
                    'subject' => $this->message,
                    'url' => route('app.congressman.payments.view')
                    ]
            );
    }

    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-text',
            'title' => 'Validación de documentos académicos',
            'description' => $this->message,
            'route' => route('app.congressman.payments.view')
        ];
    }
}
