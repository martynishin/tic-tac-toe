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

$router->get('/games', [
    'as'   => 'list.games',
    'uses' => 'GameController@list',
]);

$router->get('/games/{id}', [
    'as'   => 'get.game',
    'uses' => 'GameController@find',
]);

$router->post('/games', [
    'as'   => 'create.game',
    'uses' => 'GameController@create',
]);

$router->put('/games/{id}', [
    'as'   => 'update.game',
    'uses' => 'GameController@update',
]);

$router->delete('/games/{id}', [
    'as'   => 'delete.game',
    'uses' => 'GameController@delete',
]);
