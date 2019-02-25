<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    use HashId;

    protected $guarded  = ['id'];

    protected $hidden   = ['id','user_id'];

    protected $appends  = ['public_id'];

    protected $dates    = ['created_at', 'updated_at'];

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
    
}
