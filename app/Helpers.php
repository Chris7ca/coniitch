<?php

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