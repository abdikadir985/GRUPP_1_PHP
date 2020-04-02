<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]

$router->get('/', function () use ($router) {
  return $router->app->version();
});

$router->get('movies','MoviesController@index');

$router->get('movies/{id}','MoviesController@movieid');

$router->get('movies/regnr/{regnr}','MoviesController@getByregnr');

$router->get('movies/{id}','MoviesController@read');

$router->post('movies','MoviesController@create');

$router->put('movies/{id}','MoviesController@update');

$router->delete('movies/{id}','MoviesController@delete');
