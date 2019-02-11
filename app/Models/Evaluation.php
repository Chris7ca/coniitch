<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $hidden = ['id','criteria_id','user_id','review_id'];

    protected $appends = ['public_id'];

    public $timestamps = false;

    /**
     * Relationships
     */

    public function criteria()
    {
        return $this->belongsTo('App\Models\Criteria', 'criteria_id');
    }

}
