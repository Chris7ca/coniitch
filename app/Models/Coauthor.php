<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Coauthor extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $hidden = ['id','work_id'];

    protected $appends = ['public_id'];

    protected $casts = [
        'is_first_author' => 'boolean',
    ];

    public $timestamps = false;

}
