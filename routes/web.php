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

Route::get('/', function () { return view('list'); });
Auth::routes();
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//home
Route::get('/home', [App\Http\Controllers\ArticleController::class, 'showList'])->name('home');
Route::get('/sale/{id}', [App\Http\Controllers\ArticleController::class,'salesDetail'])->name('sales.detail');
Route::post('/sale/{id}', [App\Http\Controllers\ArticleController::class,'destroy'])->name('sales.destroy');
Route::get('/search', [App\Http\Controllers\ArticleController::class,'search'])->name('search');
Route::get('/new', [App\Http\Controllers\ArticleController::class, 'new'])->name('new');

//detail
Route::get('/sal/{id}', [App\Http\Controllers\ArticleController::class, 'salesEdit'])->name('sales.edit');
Route::get('/back', [App\Http\Controllers\ArticleController::class, 'showList'])->name('back');

//edit
Route::post('/sa/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('update');
Route::get('/sa/{id}', [App\Http\Controllers\ArticleController::class, 'salesDetail'])->name('detail.back');

//new
Route::post('newdate', [App\Http\Controllers\ArticleController::class, 'insert'])->name('newdate');