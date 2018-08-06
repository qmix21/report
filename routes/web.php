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




//Gmail Functions *****************
Route::get('/oauth/gmail', function (){
    return LaravelGmail::redirect();
});
Route::get('/oauth/gmail/callback', function (){
    LaravelGmail::makeToken();
    return redirect()->to('/index');
});

Route::get('/oauth/gmail/logout', function (){
    LaravelGmail::logout(); //It returns exception if fails
    return redirect()->to('/');
});
//**********************************
Route::get('/', function () {
    return view('welcome');
});
Route::get('/index','ReportController@index');
Route::get('/mail',"ReportController@mail");
Route::get('/refresh',"ReportController@refresh");
Route::get('/test',"ReportController@test");

Route::get('/userreport','UserReportController@create');

