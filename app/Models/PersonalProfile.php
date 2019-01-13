<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{

    protected $guarded = ['id'];

    protected $hidden = ['id','user_id'];

    protected $appends = ['age'];

    protected $dates = ['birthdate'];

    public $timestamps = false;

    /**
     * Mutators
     */

    public function getAgeAttribute()
    {
        return $this->birthdate->age;
    }

}
