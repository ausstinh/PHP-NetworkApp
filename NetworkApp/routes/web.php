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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/', function () {
    return view('login');
})->name('index');

Route::get('/register', function(){
  return view('register'); 
})->name('register');

Route::get('/home', function(){
    return view('home'); 
})->name('home');

Route::get('/profile', function(){
    return view('profile');
})->name('profile');

Route::get('logout', 'AccountController@logout')->name('logout');

Route::post('/loginuser','AccountController@login');
Route::post('/registeruser','AccountController@Register');
Route::post('/useredit','ProfileController@Edit');