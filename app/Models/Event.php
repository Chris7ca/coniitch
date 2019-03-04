<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    use HashId;

    protected $guarded  = ['id'];

    protected $hidden   = ['id'];

    protected $appends  = ['public_id'];

    public $timestamps  = false;

    /**
     * Mutators
     */

    
    /**
     * Relationships
     */

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

}
