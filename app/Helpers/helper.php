<?php
use Illuminate\Support\Env;

function env($key, $default = null)
{
    return Env::get("REMS_$key", $default);
}
