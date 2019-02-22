<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    
    use HashId, SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = ['public_id'];

    protected $hidden  = ['id'];

    protected $dates = ['deleted_at'];

    /**
     * Mutators
     */


    /**
     * Relationships
     */

    public function discount()
    {
        return $this->hasOne('App\Models\Discount');
    }

    public function for_users()
    {
        return $this->belongsToMany('App\Models\Role', 'assigned_services');
    }

}
