<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $appends = ['public_id'];

    protected $hidden = ['id','pivot'];

    public $timestamps = false;

    /**
     * Mutators
     */

    /**
     * Relationship
     */

    public function users()
    {
        return $this->belongsToMany('App\Models\Users','assigned_roles');
    }

}
