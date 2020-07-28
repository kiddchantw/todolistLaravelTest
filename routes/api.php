<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['apiLog'])->group(function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::middleware(['confirmToken'])->group(function () {
        Route::post('user/me', 'Auth\LoginController@show');
        Route::post('user/reset', 'Auth\LoginController@resetPassword');
        //unfinish 
        //Route::post('logout', 'Auth\LoginController@logout'); 

    });
    
});



//task crud api
Route::get('task', 'TaskApi@index');
Route::get('task/{id}', 'TaskApi@show');
Route::post('task', 'TaskApi@store');

Route::put('task/{tasks}', 'TaskApi@update');

Route::delete('task/{id}', 'TaskApi@destroy');
