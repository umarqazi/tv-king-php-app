<?php

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

Route::post('/signup', '\App\Http\Controllers\Api\UserSignupController@register');

Route::prefix('/brand/v1/')->group(function () {
    Route::post('/challenge/create', '\App\Http\Controllers\Api\Brand\v1\ChallengeController@store');
});
