<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $appends = ['public_id'];

    protected $hidden = ['id'];

    protected $casts  = [
        'image' => 'array'
    ];

}
