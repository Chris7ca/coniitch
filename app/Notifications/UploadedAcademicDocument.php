<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UploadedAcademicDocument extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    
    public function __construct($user)
    {
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
        return ['database'];
    }

    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-pdf',
            'title' => 'Nuevo documento probatorio de estatus académico',
            'description' => $this->user->first_name . ' ' . $this->user->last_name . ' ha ' . 'subido un documento probatorio 
            de su estatus académico. Por favor revisa dicho documento y aprueba o rechaza la válidez de dicho documento.',
            'route' => route('app.finances.records.view')
        ];
    }
}
