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



Route::get('/introduce','IntroduceController@show');




Route::any('/wechat', 'WeChatController@serve');
Route::any('/getwxconfig', 'WeChatController@getConfig');
//
//Route::get('/wxconfig','WXConfigController@getConfig');