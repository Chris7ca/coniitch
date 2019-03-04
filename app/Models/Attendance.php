<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $hidden = ['id','user_id','event_id'];

    protected $appends = ['public_id'];

    protected $dates = ['date'];

    public $timestamps = false;

    /**
     * Mutators
     */

    
    /**
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

}
