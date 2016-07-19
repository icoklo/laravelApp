<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/foo', function () {
    return 'Hello World from laravel!';
});

Route::post('/home/user', "UserController@unosKorisnika");

Route::post('/home/user/{id}', "UserController@editKorisnika");

Route::get('/home/user/{id}', "UserController@ispisPodatakaKorisnika")->where('id', '[0-9]+');

Route::get('/home/user/list', "UserController@ispisSvihKorisnika");
