<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewWorkRegister extends Notification implements ShouldQueue
{
    use Queueable;

    protected $work;
    protected $user;
    
    public function __construct($user, $work)
    {
        $this->user = $user;
        $this->work = $work;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-text',
            'title' => 'Se ha recibido un nuevo trabajo',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' ha registrado un trabajo llamado "' . $this->work->title .  '". Por favor
            asigna a dos revisores para su evaluación.',
            'route' => route('app.announcement.works.show', ['id' => $this->work->public_id])
        ];
    }
}
