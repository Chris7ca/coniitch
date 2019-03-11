<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $appends = ['public_id'];

    protected $hidden  = ['id','service_id'];

    protected $dates   = ['end_date'];

    /**
     * Relationships
     */

    public function for()
    {
        return $this->belongsToMany('App\Models\Role', 'assigned_discounts');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

}
