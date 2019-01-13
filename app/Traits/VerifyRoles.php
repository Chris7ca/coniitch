<?php

namespace App\Traits;

trait VerifyRoles 
{

    public function isRoot()
    {
        return Auth()->user()->keyRoles->contains('key', 'root');
    }

    public function isCongressman()
    {
        return Auth()->user()->keyRoles->contains('key', 'congressman');
    }

    public function hasRole($role)
    {

    }

    public function hasRoles(Array $roles)
    {

    }

}