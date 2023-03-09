<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\Images\UploadController;
use App\Http\Controllers\Tour\TourController;
use Illuminate\Support\Facades\Route;

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

Route::post('login',[LoginController::class,'login']);
Route::get('category',[CategoryController::class,'index']);
Route::get('country',[CountryController::class,'index']);
Route::prefix('tour')->controller(TourController::class)->group(function (){
    Route::get('', 'index');
    Route::get('popular','popular');
    Route::get('sale','sale');
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('logout','logout');
        Route::post('refresh-token','refreshToken');
    });
    Route::prefix('tour')->controller(TourController::class)->group(function (){
        Route::post('store', 'store');
        Route::put('update','update');
    });
    Route::post('upload',[UploadController::class,'upload']);
    Route::apiResource('category',CategoryController::class,['except' => 'index']);
    Route::apiResource('country',CountryController::class,['except' => 'index']);
});
