<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteredUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.default')
            ->subject('Nuevo usuario registrado')
            ->with([
                'notification' => 'Un nuevo usuario se ha registrado',
                'subject' => $this->user->first_name . ' ' . $this->user->last_name,
                'url' => route('app.finances.records.view')
            ]);
    }
}
