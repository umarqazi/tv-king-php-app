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
        Route::post('/challenges', '\App\Http\Controllers\Api\Brand\v1\ChallengeController@store');
        Route::post('/logout', '\App\Http\Controllers\Api\Brand\v1\SignupController@logout');
        Route::post('/change-password', '\App\Http\Controllers\Api\Brand\v1\SignupController@changePassword');
    });

    //Admin APIs
    Route::prefix('/admin/v1/')->group(function () {
        Route::post('/logout', '\App\Http\Controllers\Api\Admin\v1\SignupController@logout');
        Route::post('/change-password', '\App\Http\Controllers\Api\Admin\v1\SignupController@changePassword');

    });

    //Customer APIs
    Route::prefix('/customer/v1/')->group(function () {
        Route::post('/logout', '\App\Http\Controllers\Api\Customer\v1\SignupController@logout');
        Route::post('/change-password', '\App\Http\Controllers\Api\Customer\v1\SignupController@changePassword');

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

    Route::post("/tags", '\App\Http\Controllers\Api\Admin\v1\TagController@store');
    Route::get("/tags", '\App\Http\Controllers\Api\Admin\v1\TagController@index');
    Route::get("/tags/{id}", '\App\Http\Controllers\Api\Admin\v1\TagController@view');

});

//Customer APIs
Route::prefix('/customer/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Customer\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Customer\v1\SignupController@login');

});
