<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    
    use HashId;

    protected $guarded  = ['id'];

    protected $hidden   = ['id','user_id'];

    protected $appends  = ['public_id'];

    protected $dates    = ['created_at', 'updated_at'];

    protected $casts    = ['ready' => 'boolean'];

    /**
     * Mutators
     */

    public function getCreatedAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAgoAttribute()
    {
        $this->updated_at->diffForHumans();
    }

    /**
     * Relationships
     */

    public function registered_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function coauthors()
    {
        return $this->hasMany('App\Models\Coauthor');
    }

    public function revisors()
    {
        return $this->belongsToMany('App\Models\User','revisors')
        ->withPivot('status')
        ->as('confirmation');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    

}
