<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicProfile extends Model
{

    protected $guarded = ['id'];

    protected $hidden = ['id','user_id'];

    protected $casts = [
        'is_student' => 'boolean'
    ];

    public $timestamps = false;

    /**
     * Mutators
     */


}
