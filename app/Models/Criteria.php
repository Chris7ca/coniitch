<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    
    use HashId;

    protected $guarded  = ['id'];

    protected $hidden   = ['id'];

    protected $appends  = ['public_id'];

    protected $dates    = ['created_at', 'updated_at'];

    /**
     * Mutators
     */

    public function getCreatedAgoAttribute()
    {
        $this->created_at->diffForHumans();
    }

    public function getUpdatedAgoAttribute()
    {
        $this->updated_at->diffForHumans();
    }

    /**
     * Relationships
     */

}
