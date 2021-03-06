<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('/user/login', 'UserController@loginUser');

$router->post('/user/register', 'UserController@registerUser');

$router->get('/dte/token/{token}','DteController@getDteByToken');

$router->post('/dte/pay','DteController@payDte');

$router->group(['middleware' => 'jwt'], function () use ($router) {
    $router->post('/dte/create', 'DteController@createDte');
    $router->post('/dte/list', 'DteController@listDte');
    $router->get('/dte/list/frequency/{frequency}', 'DteController@listDteByFrequency');
    $router->get('/user/balance', 'UserController@getBalance');
});
