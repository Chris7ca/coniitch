<?php

function activeLink($url)
{
    return ( starts_with(request()->path(), $url) ) ? 'uk-active' : '';
}