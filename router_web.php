<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]
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
//registrerar urlen i lumen
$router->get('/', function () use ($router) {
    return $router->app->version();
});
//testar och ser om JSON funkar
$router->get('test','MoviesController@test');
//hämtar själva indexen till movies (allting sorterat.)
//exempel: (http://localhost/lumen/public/movies)
$router->get('movies','MoviesController@index');
//låter dig läsa upp en movie utefter dess id
//exempel: (http://localhost/lumen/public/movies/1)
$router->get('movies/{id}','MoviesController@read');
//denna låter dig lägga till nya filmer i databasen
$router->post('movies','MoviesController@create');
//denna låter dig uppdatera den nuvarande innehåll inom id:n till något nytt.
$router->put('movies/{id}','MoviesController@update');
//denna låter dig ta bort själva id:t och dess innehåll helt och hållet.
$router->delete('movies/{id}','MoviesController@delete');
