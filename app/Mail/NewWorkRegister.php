<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewWorkRegister extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $work;

    public function __construct($work)
    {
        $this->work = $work;
    }

    public function build()
    {
        return $this->view('mails.default')
            ->subject('Nuevo trabajo')
            ->with([
                'notification' => 'Se recibió un nuevo trabajo',
                'subject' => '"'. $this->work->title .'"',
                'url' => route('app.announcement.works.show', ['id' => encode_id($this->work->id)])
            ]);
    }
}
