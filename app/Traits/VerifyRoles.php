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

    public function isPublicRelations()
    {
        return Auth()->user()->keyRoles->contains('key', 'public-relations');
    }

    public function isAdmin()
    {
        return Auth()->user()->keyRoles->contains('key', 'admin');
    }

    public function isRevisor()
    {
        return Auth()->user()->keyRoles->contains('key', 'revisor');
    }

    public function isFinances()
    {
        return Auth()->user()->keyRoles->contains('key', 'finances');
    }

    public function hasRole($role)
    {

    }

    public function hasRoles(Array $roles)
    {

    }

}