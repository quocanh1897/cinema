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

Route::get('404',[
    'as'=>'404',
    'uses'=>'PageController@get404'
]);

Route::get('about',[
    'as'=>'about',
    'uses'=>'PageController@getAbout'
]);

Route::get('phim-dang-chieu',[
    'as'=>'phim-dang-chieu',
    'uses'=>'PageController@phimDangChieu'
]);

Route::get('phim-sap-chieu',[
    'as'=>'phim-sap-chieu',
    'uses'=>'PageController@phimSapChieu'
]);

Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);
