<?php

use Illuminate\Support\Facades\Route;
use App\TaskStatus;

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

Route::post('/contact', 'HomeController@store');

Route::resource('task_statuses', 'TaskStatusController');
Route::resource('tasks', 'TaskController');
Route::resource('labels', 'LabelController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
