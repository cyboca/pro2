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
    Route::get('accounts',function (){
        $user=new \App\User();
        $result=$user->get_password();
        return $result;
    });
    Route::get('spaces',function (){
        $managers=new \App\Manager();
        $result=$managers->get_all_managers();
        return $result;
    });
    Route::get('deploy','UserController@deploy');
});

Route::get('/index',"IndexController@index");

Route::post('/login','UserController@login');

Route::get('/logout','UserController@logout');

Route::post('/register','UserController@register');

//Route::get('/test','AdminController@test');
//Route::get('/test',function (){
//    $manager=new \App\Manager();
//    return $manager->get_size();
//});



/* page to input access code */
Route::get('admin','AdminController@index');

/* page to get the post and login */
Route::post('access','AdminController@login');

Route::post('chosespace','UserController@chosespace');

/* backend pages use admin check */
Route::group(['middleware'=>'admincheck'],function (){
    Route::get('backend','AdminController@backend');
    Route::get('managers','ManagerController@index');
    Route::get('space','AdminController@space');
    Route::get('adminlogout','AdminController@logout');
    Route::post('deletespace','AdminController@deletespace');
    Route::get('modifyspace','AdminController@modifyspace');
    Route::post('modifyspace','AdminController@modifyspacelimit');
});

Route::post('managerregister','ManagerController@register');