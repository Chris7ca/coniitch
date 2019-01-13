<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{

    protected $guarded = ['id'];

    protected $hidden = ['id','user_id'];

    public $timestamps = false;

    /**
     * Mutators
     */

}
