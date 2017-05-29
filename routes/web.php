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

$app->get('/', function () use ($app) {
    return response()->json(['message' => 'This is an API, wrong URL... NERD']);
});

// File logic
$app->get('/files', 'FilesController@index');
$app->get('/file/{id}', 'FilesController@single');
$app->post('/file', 'FilesController@create');

// Rating logic
$app->post('/rate', 'RatingController@create');

// User logic
$app->get('/user/{id}', 'UserController@get');

$app->post('/login', 'AuthController@postLogin');
$app->post('/me', 'AuthController@me');
$app->post('/register', [
    'as' => 'user', 'uses' => 'UserController@store'
]);

$app->get('/auth/steam', [
    'as' => 'SteamAuth', 'uses' => 'AuthController@redirectToProvider'
]);
$app->get('/auth', [
    'as' => 'SteamRedirect', 'uses' => 'AuthController@handleProviderCallback'
]);