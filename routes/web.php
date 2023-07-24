<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\StudentsController;
use app\Http\Controllers\StudentsController;
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

Route::get('/','App\Http\Controllers\StudentsController@index');
Route::post('/students','App\Http\Controllers\StudentsController@uploadContent')->name('students');

