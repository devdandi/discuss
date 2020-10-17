<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','ProfileController@index')->name('profile');
Route::get('/profile/stalk/{id}','ProfileController@stalk')->name('profile.stalk');
Route::post('/profile/update','ProfileController@updateProfile')->name('profile.update');
Route::post('/home/posting','HomeController@updatePostingan')->name('postingan.update');
Route::post('/home/posting/like','HomeController@postingan_like')->name('postingan.like');
Route::post('/home/posting/komentar','HomeController@postingan_komentar')->name('postingan.komentar');
Route::post('/profile/pesan','PesanController@index')->name('pesan.create');
Route::get('/profile/pesan','PesanController@read')->name('pesan.read');





