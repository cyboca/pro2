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

Route::group(['middleware'=>'checklogin'],function (){
    Route::get('home','HomeController@index');
});

Route::get('/index',"IndexController@index");

Route::post('/login','UserController@login');

Route::get('/logout','UserController@logout');

Route::post('/register','UserController@register');

Route::get('/test','TestController@index');

/* page to input access code */
Route::get('admin','AdminController@index');

/* page to get the post and login */
Route::post('access','AdminController@login');

/* backend pages use admin check */
Route::group(['middleware'=>'admincheck'],function (){
    Route::get('backend','AdminController@backend');
    Route::get('managers','AdminController@managers');
    Route::get('space','AdminController@space');
    Route::get('adminlogout','AdminController@logout');
});

Route::get('managerlist','AdminController@test');