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

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show']);
Route::post('/post', [App\Http\Controllers\PostController::class, 'store']);
Route::post('/post/delete', [App\Http\Controllers\PostController::class, 'destroy']);
Route::post('/post/movimentar', [App\Http\Controllers\PostController::class, 'movimentar']);
Route::post('/post/editar',[App\Http\Controllers\PostController::class, 'update']);
Route::post('/post/situation/edit',[App\Http\Controllers\PostController::class, 'setSituation']);
Route::post('/post/time/edit',[App\Http\Controllers\PostController::class, 'setTime']);

Route::post('/message',[App\Http\Controllers\MessageController::class, 'store']);
Route::post('/message/delete',[App\Http\Controllers\MessageController::class, 'destroy']);

Route::get('/situations',[App\Http\Controllers\SituationController::class, 'index']);