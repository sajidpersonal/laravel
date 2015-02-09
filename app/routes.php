<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){return View::make('hello');});

Route::get('login', array('uses' => 'UserController@login','as' => 'login'));
Route::post('login', array('uses' => 'UserController@login_auth','as' => 'login.auth'));

Route::get('register', array('uses' => 'UserController@register','as' => 'register'));
Route::post('register', array('uses' => 'UserController@register_save','as' => 'register.save'));

Route::get('forgot_password', array('uses' => 'UserController@forgotPassword','as' => 'forgot_password'));
Route::post('forgot_password', array('uses' => 'UserController@forgotPasswordSend','as' => 'forgot_password'));
Route::get('logout', array('uses' => 'UserController@logout','as' => 'logout'));
Route::get('verify/{token}', array('uses' => 'UserController@verify','as' => 'verify'));

Route::get('dashboard', array('uses' => 'UserController@dashboard','as' => 'dashboard'));