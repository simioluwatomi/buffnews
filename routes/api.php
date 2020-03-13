<?php

use App\Http\Controllers\ApiNewsController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1',], function () {

    Route::get('/news', [ApiNewsController::class, 'index'])->name('api.news.index');

    Route::get('/news/{news}', [ApiNewsController::class, 'show'])->name('api.news.show');

});

