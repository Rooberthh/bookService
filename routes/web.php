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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('books',  ['uses' => 'BookController@index']);
    $router->post('books',  ['uses' => 'BookController@store']);
    $router->patch('books/{id}',  ['uses' => 'BookController@update']);
    $router->delete('books/{id}',  ['uses' => 'BookController@destroy']);

    $router->get('genres',  ['uses' => 'GenreController@index']);
});
