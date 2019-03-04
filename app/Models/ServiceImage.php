<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    
    use HashId;

    protected $guarded  = ['id'];

    protected $appends  = ['public_id'];

    protected $hidden   = ['id','service_id'];

    public $timestamps  =  false;

    /**
     * Mutators
     */

    
    /**
     * Relationships
     */

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

}
