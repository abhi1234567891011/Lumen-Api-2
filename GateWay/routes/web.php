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

/**
 *  
 * * Routes for users 
 * */

$router->group(['middleware' => 'client.credentials'], function () use ($router){

$router->get('/users', 'UserController@index'); 
$router->post('/users', 'UserController@store'); 
$router->get('/users/{id}', 'UserController@show'); 
$router->put('/users/{id}', 'UserController@update'); 
$router->patch('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@destroy'); 

 /** 
  * 
  * Routes for todos
   */ 
$router->get('/todos', 'TodoController@index'); 
$router->post('/todos', 'TodoController@store');
$router->get('/todos/{id}', 'TodoController@show'); 
$router->put('/todos/{id}', 'TodoController@update'); 
$router->patch('/todos/{id}', 'TodoController@update');
$router->delete('/todos/{id}', 'TodoController@destroy'); 
  
});