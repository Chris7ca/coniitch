<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EvaluateWork extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-edit',
            'title' => 'Evaluación de trabajos',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' ha evaluado un trabajo que le has asignado. Puedes ver su 
            evaluación en tu panel de control.',
            'route' => route('app.admin.works.view')
        ];
    }
}
