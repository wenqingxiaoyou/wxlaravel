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

Route::group(['middleware'=>['web','wechat.oauth']],function(){
    Route::get('/mwxoauth','WeChatController@mwxoauth');
});

Route::get('/introduce','IntroduceController@show');
Route::get('/login','IntroduceController@login');
Route::get('/show','IntroduceController@showback');




Route::any('/wechat', 'WeChatController@serve');
Route::any('/oauth', 'WeChatController@oauthConfirm');
Route::any('/wxoauth', 'WeChatController@wxoauth');

Route::any('/getwxconfig', 'WeChatController@getConfig');
//
//Route::get('/wxconfig','WXConfigController@getConfig');