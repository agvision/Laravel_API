<?php
header('Access-Control-Allow-Origin: *');
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This route group applies for the API.
|
*/

Route::group(['prefix' => 'api'], function () {

    Route::post('login',    'API\UsersController@login');
    Route::post('register', 'API\UsersController@register');
    Route::post('logout',   'API\UsersController@logout');

    /**
     * Authenticated routes
     */
    Route::group(['middleware' => 'jwt.auth'], function() {
    	Route::get('user', 'API\UsersController@user');
    });
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
