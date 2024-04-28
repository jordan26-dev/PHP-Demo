<?php


use Core\Session;
use Core\ValidationException;


const BASE_PATH = __DIR__ . '/../';
//var_dump(BASE_PATH);   
require BASE_PATH . 'vendor/autoload.php'; 

session_start();

require BASE_PATH . 'Core/functions.php';



/* spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
     
    require base_path("{$class}.php");

});  */


require base_path('bootstrap.php');


$router = new \Core\Router();

$routes = require base_path("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; //parse_url, separates the url from the query string

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



try {
    $router->route($uri, $method);

} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);
    
    redirect($router->previousUrl());
}


//expires the errors session
Session::unflash();





