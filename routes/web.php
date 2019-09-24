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

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('landing.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/calendar', function () {
//     return view('calendar.index');
// });

Route::resource('/calendar', 'ReservationsController');

Route::get('/dashboard', 'AdminController@index');

// To clear the cache

Route::get('/clear-cache', function() {
    Artisan::call('clear-compiled');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
