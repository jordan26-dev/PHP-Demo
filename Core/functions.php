<?php


use Core\Response;
use Core\Session;

function dd($value)
{
    echo'<pre>';
    var_dump($value);
    echo'</pre>';

    die();
}


function urlIs($value) 
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($value, $response = Response::FORBIDDEN)
{
    if(! $value)
    {
        abort($response);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
   
    require base_path('views/' . $path);
}

function abort($code = 404) 
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}

