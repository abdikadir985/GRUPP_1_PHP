<?php

// lab 2 Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend Zebari]


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

$router->get('movies','MovieController@index');


$router->get('movies/{id}','MovieController@movieid')

