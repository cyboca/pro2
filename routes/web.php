<?php

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

Route::get('/home', 'HomeController@index');
//Route::get('/home',function (){
//   return view('test');
//});

Route::get('/index',"IndexController@index");

Route::post('/login','UserController@login');

Route::get('/logout','UserController@logout');

Route::post('/register','UserController@register');
