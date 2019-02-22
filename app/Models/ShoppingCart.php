<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    
    use HashId;

    protected $table    = 'shopping_cart';

    protected $guarded  = ['id'];

    protected $appends  = ['public_id'];

    protected $hidden   = ['id','user_id','service_id'];

    public $timestamps  = false;

    /**
     * Relationships
     */

    public function service()
    {
        return $this->hasOne('App\Models\Service','id','service_id');
    }

}
