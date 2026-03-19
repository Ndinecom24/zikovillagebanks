<?php
use Illuminate\Support\Env;

function env($key, $default = null)
{
    return Env::get($key, $default);
}
