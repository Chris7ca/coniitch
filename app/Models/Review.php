<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $hidden = ['id','user_id','work_id'];

    protected $appends = ['public_id'];

    protected $dates = ['created_at', 'updated_at'];

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

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }

}
