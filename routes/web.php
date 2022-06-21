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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/post', [App\Http\Controllers\PostController::class, 'store']);
Route::post('/post/delete', [App\Http\Controllers\PostController::class, 'destroy']);
Route::post('/post/movimentar', [App\Http\Controllers\PostController::class, 'movimentar']);