<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = ['id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'has_personal_profile' => 'boolean',
        'has_academic_profile' => 'boolean',
        'has_emergency_contact' => 'boolean'
    ];


    /**
     * Notificación de confirmación de email
     */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Notificación de reseteo de contraseña 
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
