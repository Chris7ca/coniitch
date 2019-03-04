<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HashId;
use App\Traits\VerifyRoles;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HashId, VerifyRoles, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = ['id','password', 'remember_token'];

    protected $appends = ['public_id'];

    protected $dates = ['created_at','updated_at'];

    protected $casts = [
        'has_personal_profile' => 'boolean',
        'has_academic_profile' => 'boolean',
        'has_emergency_contact' => 'boolean'
    ];

    /**
     * Mutators
     */

    public function getCreatedAgoAttribute()
    {
        $date = new Carbon($this->created_at);
        
        return $date->diffForHumans();
    }

    public function reference()
    {
        return str_pad($this->id, (7 - strlen($this->id)), '0', STR_PAD_RIGHT);
    }
    
    /**
     * Relationships
     */

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'assigned_roles');
    }

    public function keyRoles()
    {
        return $this->belongsToMany('App\Models\Role', 'assigned_roles')
            ->select(['id','key']);
    }

    public function academic_profile()
    {
        return $this->hasOne('App\Models\AcademicProfile');
    }

    public function personal_profile()
    {
        return $this->hasOne('App\Models\PersonalProfile');
    }

    public function professional_profile()
    {
        return $this->hasOne('App\Models\ProfessionalProfile');
    }

    public function invoicing_data()
    {
        return $this->hasOne('App\Models\InvoicingData');
    }

    public function emergency_contact()
    {
        return $this->hasOne('App\Models\EmergencyContact');
    }

    public function work()
    {
        return $this->hasOne('App\Models\Work');
    }

    public function assigned_works()
    {
        return $this->belongsToMany('App\Models\Work', 'revisors')
        ->withPivot('status')
        ->as('confirmation');
    }

    public function shopping_cart()
    {
        return $this->hasMany('App\Models\ShoppingCart');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * @ Override
     * Notificación de confirmación de email
     */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @ Override
     * Notificación de reseteo de contraseña 
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
