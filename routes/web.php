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
    // return $router->app->version();
    return view('home');
});

// $router->get('/', 'ExampleController@index');

// Vehicle
$router->get('/vehicle', 'VehiclesController@index');
$router->get('/vehicle/getData', 'VehiclesController@getData');
$router->get('/vehicle/{id}', 'VehiclesController@get');
$router->post('/vehicle', 'VehiclesController@store');
$router->get('/vehicle/delete/{id}', 'VehiclesController@destroy');

// Sparepart
$router->get('/sparepart', 'SparepartController@index');
$router->get('/sparepart/getData', 'SparepartController@getData');
$router->get('/sparepart/{id}', 'SparepartController@get');
$router->post('/sparepart', 'SparepartController@store');
$router->get('/sparepart/delete/{id}', 'SparepartController@destroy');

// History
$router->get('/history/{id}', 'HistoryController@index');
$router->get('/history/getData/{id}', 'HistoryController@getData');
$router->get('/history/find/{id}', 'HistoryController@get');
$router->post('/history', 'HistoryController@store');
$router->get('/history/delete/{id}', 'HistoryController@destroy');
