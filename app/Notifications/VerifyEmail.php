<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The callback that should be used to build the mail message.
     *
     */
    public static $toMailCallback;

    /**
     * Get the notification's delivery channels.
     * 
     */

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     * 
     */

    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }     

        $action = $this->verificationUrl($notifiable);

        // if (app()->getLocale() == 'es')
        // {
        //     Carbon::setLocale('es');
        //     Carbon::setUTF8(true);
        //     setlocale(LC_TIME,'Spanish');
        // }
        $date = $date = now()->formatLocalized('%B %d, %Y');

        return (new MailMessage)
            ->subject('Correo de verificación')
            ->view(
                'mails.verifyemail', ['action' => $action, 'date' => title_case($date)]
            );
    }

    /**
     * Generación de la url para la verificación de correo
     *
     */

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['token' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     */

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
    
}
