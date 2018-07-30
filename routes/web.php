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

Route::get('/',function (){
    return view('welcome');
});

Route::group(['middleware'=>['web']],function (){
    Route::get('/users','UsersController@users');
    Route::get('/users/{openId}','UsersController@user');
});

Route::get('/introduce','IntroduceController@show');




Route::any('/wechat', 'WeChatController@serve');
Route::any('/getwxconfig', 'WeChatController@getConfig');
//
//Route::get('/wxconfig','WXConfigController@getConfig');