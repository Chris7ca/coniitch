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

    protected $status;

    protected $accepted = 'Hemos recibido el documento probatorio de su actual estado académico, y debido
    a ello, le otorgamos un descuento al momento de realizar su pago de inscripción al congreso.
    Acceda al siguiente enlace abriendo esta notificación';

    protected $rejected = 'Hemos recibido el documento probatorio de
    su actual estado académico, lamentablemente no podemos otorgarle un descuento para inscripción al congreso,
    de todas formas esperamos verlo muy pronto, si desea realizar su pago de inscripción, abra esta notificación';
    
    public function __construct($user, $status)
    {
        $this->user = $user;
        $this->status = ($status) ? $this->accepted : $this->rejected ;
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
                    'subject' => $this->status,
                    'url' => route('app.congressman.payments.view')
                    ]
            );
    }

    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-text',
            'title' => 'Validación de documentos académicos',
            'description' => $this->status,
            'route' => route('app.congressman.payments.view')
        ];
    }
}
