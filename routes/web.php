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

/** @var TYPE_NAME $router */
$router->group(['prefix'=>'api'], function() use($router){
    $router->get('/packet', 'PacketController@index');
    $router->post('/packet', 'PacketController@create');
    $router->post('/packet/getPacket', 'TransactionController@getPacket');
    $router->post('/packet/getTransaction', 'TransactionController@getTransaction');
});
