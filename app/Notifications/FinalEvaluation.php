<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FinalEvaluation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $work;

    public function __construct($work)
    {
        $this->work = $work;
    }


    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toMail($notifiable)
    {

        $date = $date = now()->formatLocalized('%B %d, %Y');

        return (new MailMessage)
            ->subject('Evaluación de trabajos')
            ->view(
                'mails.evaluationwork', ['work' => $this->work, 'date' => title_case($date)]
            );
    }
    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'rss',
            'title' => 'Han evaluado tu trabajo',
            'description' => 'Un par de investigadores capacitados ha revisado tu trabajo y lo han evaluado de acuerdo a una serie de criterios. Podrás ver su evaluación en el menú 
            "Convocatoria".',
            'route' => route('app.congressman.announcement.view')
        ];
    }
}
