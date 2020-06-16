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


//寫法1 ok
// Route::get('task', 'TaskApi@index');
// Route::get('task/{id}', 'TaskApi@show');
// Route::post('task', 'TaskApi@store');
// Route::put('task/{id}', 'TaskApi@update');
// Route::delete('task/{id}', 'TaskApi@destroy');



//寫法2 ok
Route::apiResource('task', 'TaskApi');
