<?php

use App\Tasks;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/todolist', 'Controller@todolistIndex');

Route::post('/todolistLogin', 'UsersController@loginTest');
Route::post('/todolistAddTask', 'TasksController@addTask');
Route::get('/readTask/{id}', 'TasksController@readTask');
Route::get('/readTaskById/{id}', 'TasksController@readTaskById');


Route::post('updateTask', 'TasksController@updateTask')->name('updateTask.post');
Route::post('deleteTask', 'TasksController@deleteTask')->name('delete.post');


//api的移動到 api.php
// Route::get('/todolist/task', 'TaskApi@index');
// Route::get('/todolist/task/{id}', 'TaskApi@show');


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/first',function(){
    // echo Tasks::all()->first();
    echo Tasks::find(1)->count();
});