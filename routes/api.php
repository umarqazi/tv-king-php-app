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

Route::group(['middleware' => 'jwt.auth'], function () {

    //Brand APIs
    Route::prefix('/brand/v1/')->group(function () {
        Route::post('/challenge/create', '\App\Http\Controllers\Api\Brand\v1\ChallengeController@store');
        Route::post('/logout', '\App\Http\Controllers\Api\Brand\v1\SignupController@logout');
        Route::post('/password/reset', '\App\Http\Controllers\Api\Brand\v1\SignupController@passwordReset');
    });

    //Admin APIs
    Route::prefix('/admin/v1/')->group(function () {
        Route::post('/logout', '\App\Http\Controllers\Api\Admin\v1\SignupController@logout');

    });

    //Customer APIs
    Route::prefix('/customer/v1/')->group(function () {
        Route::post('/logout', '\App\Http\Controllers\Api\Customer\v1\SignupController@logout');
    });
});

//Brand APIs
Route::prefix('/brand/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Brand\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Brand\v1\SignupController@login');
});

//Admin APIs
Route::prefix('/admin/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Admin\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Admin\v1\SignupController@login');

});

//Customer APIs
Route::prefix('/customer/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Customer\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Customer\v1\SignupController@login');

});
