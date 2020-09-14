<?php

use Illuminate\Support\Facades\Auth;
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
    return view('home');
})->name('home');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('login/login', 'App\Http\Controllers\LoginController@login')->name('login_action');

Route::get('/tickets', 'App\Http\Controllers\TicketController@index')->name('tickets');
