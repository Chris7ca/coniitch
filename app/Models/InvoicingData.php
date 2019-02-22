<?php

namespace App\Models;

use App\Traits\HashId;
use Illuminate\Database\Eloquent\Model;

class InvoicingData extends Model
{
    
    use HashId;

    protected $table    = 'invoicing_data';

    protected $guarded  = ['id'];

    protected $hidden   = ['id','user_id'];

    protected $appends  = ['public_id'];

    public $timestamps  = false;

}
