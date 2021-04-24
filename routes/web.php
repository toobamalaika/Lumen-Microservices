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

$router->group(['prefix'=>'user'], function() use($router){

    $router->get('/list', 'UserController@index'); //for list of users
    $router->post('/create', 'UserController@create'); // new user create
    $router->get('/show/{id}', 'UserController@show'); // show specific user
    $router->post('/update/{id}', 'UserController@update'); // update specific user
    $router->delete('/delete/{id}', 'UserController@destroy'); // delete specific user

});
