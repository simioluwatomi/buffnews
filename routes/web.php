<?php

use App\Http\Controllers\NewsController;

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

Route::get('/', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::delete('/news/{news:slug}', [NewsController::class, 'destroy'])->name('news.delete')->middleware('auth');
Route::get('/news/{news:slug}/edit', [NewsController::class, 'edit'])->name('news.edit')->middleware('auth');
Route::patch('/news/{news:slug}/edit', [NewsController::class, 'update'])->name('news.update')->middleware('auth');
