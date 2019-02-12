<?php

use App\Models\User;
use Vinkla\Hashids\Facades\Hashids;

/**
 * 
 */

function activeLink($url)
{
    return ( starts_with(request()->path(), $url) ) ? 'uk-active' : '';
}

/**
 * 
 */

function decode_id($id)
{
    return (int) Hashids::decode($id)[0];
}

/**
 * 
 */

function encode_id($id)
{
    return Hashids::encode($id);
}

/**
 * 
 */

function avatar($avatar)
{
    if ( starts_with($avatar, 'https') ) {

        return $avatar;

    } elseif ( $avatar != null && !starts_with($avatar, 'https') ) {

        return Storage::url($avatar);

    } else {

        return '/images/avatar.png';
        
    }
}

/**
 * 
 */

function getUsersByRole($role)
{
    return User::select('id')->whereHas('roles', function($query) use ($role) {
        $query->where('key', $role);
    })->get();
}