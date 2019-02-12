<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResponseToAssignment extends Notification
{
    use Queueable;

    protected $work;

    protected $user;

    protected $response;

    public function __construct($work, $user, $response)
    {
        $this->work = $work;
        $this->user = $user;
        $this->response = $response;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'icon' => ($this->response) ? 'check' : 'ban',
            'title' => 'Han respondido a la asignación de un trabajo',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' ha ' . ($this->response) ? 'aceptado' : 'rechazado' . ' el trabajo "'
            . $this->work->title . '". Puedes verificarlo en el menú trabajos, en la pestaña asignados.',
            'route' => route('app.admin.works.view')
        ];
    }
}
