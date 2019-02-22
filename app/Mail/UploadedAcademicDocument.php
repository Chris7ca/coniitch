<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadedAcademicDocument extends Mailable implements ShouldQueue
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
            ->subject('Nuevo documento probatorio de estatus académico')
            ->with([
                'notification' => 'Nuevo documento probatorio de estatus académico',
                'subject' => $this->user->first_name . ' ' . $this->user->last_name . ' ha ' . 'subido un documento probatorio 
                de su estatus académico. Por favor revisa dicho documento y aprueba o rechaza la válidez de dicho documento.',
                'url' => route('app.finances.records.view')
            ]);
    }
}
