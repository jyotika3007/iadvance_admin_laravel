<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    // Auth Routes
    Route::post('login','AuthController@postLogin');
    Route::post('register','AuthController@postRegister');
    Route::post('verifyOtp','AuthController@verifyOtp');
    Route::post('resetPassword','AuthController@resetPassword');
    Route::post('forgotPassword','AuthController@forgotPassword');
    
    
    // Honme Page routes
    Route::get('home_products','HomeController@home_products');
    Route::get('home_main','HomeController@home_main');
    Route::get('categoriesList','HomeController@categories');

});