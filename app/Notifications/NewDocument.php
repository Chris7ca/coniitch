<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewDocument extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    protected $document;

    public function __construct($user, $document)
    {
        $this->user = $user;
        $this->document = $document;
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

    
    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuevo documento')
            ->view(
                'mails.default', [
                    'notification' => 'Estimado(a) '. $this->user->first_name .' '. $this->user->last_name .',',
                    'subject' => 'Le notificamos que se ha agregado "'. $this->document->title .'", a la lista de tus documentos. Puedes verlo abriendo esta notificación.',
                    'url' => route('app.congressman.documents.view')
                    ]
            );
    }

    
    
    public function toArray($notifiable)
    {
        return [
            'icon' => 'file-pdf',
            'title' => 'Nuevo documento',
            'description' => 'Se ha agregado "'. $this->document->title .'" a la lista de tus documentos. Puedes verlo abriendo esta notificación.',
            'route' => route('app.congressman.documents.view')
        ];
    }
}
