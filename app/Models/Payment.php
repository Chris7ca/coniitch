<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    use HashId;

    protected $guarded  = ['id'];

    protected $hidden   = ['id','user_id'];

    protected $appends  = ['public_id'];

    protected $dates    = ['created_at'];

    protected $casts    = [
        'status'                => 'boolean',
        'required_invoice'      => 'boolean',
        'required_translate'    => 'boolean'
    ];

    /**
     * Mutators
     */

    public function getCreatedAgoAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->diffForHumans();
    }

    /**
     * Relationships
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service')
            ->withTrashed();
    }

}
