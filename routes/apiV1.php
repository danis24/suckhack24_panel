<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/ppuser', 'PaypalUserController@browse');
$router->get('/ppuser/{id}', 'PaypalUserController@read');
$router->patch('/ppuser/{id}', 'PaypalUserController@edit');
$router->post('/ppuser', 'PaypalUserController@add');
$router->delete('/ppuser/{id}', 'PaypalUserController@delete');

$router->get('/user', 'UserController@browse');
$router->get('/user/{id}', 'UserController@read');
$router->patch('/user/{id}', 'UserController@edit');
$router->post('/user', 'UserController@add');
$router->delete('/user/{id}', 'UserController@delete');
