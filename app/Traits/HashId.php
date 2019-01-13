<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashId
{

    public function getPublicIdAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function getHashId()
   {
      return Hashids::encode($this->id);
   }
   
}