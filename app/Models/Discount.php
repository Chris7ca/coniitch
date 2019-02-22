<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    
    use HashId;

    protected $guarded = ['id'];

    protected $appends = ['public_id'];

    protected $hidden  = ['id','service_id'];

    protected $dates   = ['end_date'];

    protected $casts   = [
        'discount' => 'decimal:2',
    ];

}
