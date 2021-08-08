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

$router->get('/dimensions', 'DimensionController@index');
$router->get('/dimensions/{id}', 'DimensionController@find');
$router->post('/dimensions', 'DimensionController@store');
$router->put('/dimensions/{id}', 'DimensionController@update');
$router->delete('/dimensions/{id}', 'DimensionController@delete');

$router->get('/questions', 'QuestionController@index');
$router->get('/questions/{id}', 'QuestionController@find');
$router->post('/questions', 'QuestionController@store');
$router->put('/questions/{id}', 'QuestionController@update');
$router->delete('/questions/{id}', 'QuestionController@delete');
