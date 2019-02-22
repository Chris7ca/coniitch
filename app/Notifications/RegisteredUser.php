<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredUser extends Notification implements ShouldQueue
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
            'icon' => 'user',
            'title' => 'Nuevo registro',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' se ha registrado en la plataforma, si deseas ver mas información al repecto
            puedes abrir esta notificación.',
            'route' => route('app.finances.records.view')
        ];
    }
}
