<?php

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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/','StudentController@index');
Route::get('/register','StudentController@create');
Route::get('/deleteData','StudentController@destory');
Route::get('/getData','StudentController@fetchData');
Route::get('/hasone','StudentController@show');
