<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignWorkToEvaluate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $work;

    public function __construct($work)
    {
        $this->work = $work;
    }
    
    public function via($notifiable)
    {
        return ['database'];
    }
    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'search',
            'title' => 'Te ha sido asignado un trabajo a evaluar',
            'description' => 'El titulo del trabajo es "' . $this->work->title . '". Por favor responde los más pronto posible y recuerda que en caso de aceptar 
            el trabajo a evaluar, cuentas con 3 días para hacerlo.',
            'route' => route('app.revisors.works.view')
        ];
    }
}
