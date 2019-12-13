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

Route::get('/complaints', function () {
    return view('complaints');
})->middleware('auth');

Route::get('/assets', function () {
    return view('assets');
})->middleware('auth');

Route::get('/', function () {
    return view('service_book');
})->middleware('auth');

Route::get('/service', function () {
    return view('service_book');
})->middleware('auth');
Route::get('/book', 'CategoryController@bookForm');
//Route::get('/book', function () {
//    return view('Book_Complaint');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
