<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCreatorController;
use App\Http\Controllers\UserController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute untuk Manajemen Buku
Route::resource('books', BookController::class)->middleware('auth');

// Rute untuk Manajemen Penulis
Route::resource('bookcreators', BookCreatorController::class)->middleware('auth');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
});
Route::get('/reset-password', 'App\Http\Controllers\UserController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'App\Http\Controllers\UserController@resetPassword')->name('password.update');
