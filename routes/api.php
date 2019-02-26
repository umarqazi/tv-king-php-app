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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Admin APIs
Route::prefix('/admin/v1/')->group(function () {
    /**
     * Public Routes
     */
    Route::post('/signup', '\App\Http\Controllers\Api\Admin\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Admin\v1\LoginController@index');

    Route::group(['middleware' =>[ 'jwt.auth', 'admin.authenticator']], function(){
        Route::post('/forgot-password', '\App\Http\Controllers\Api\Admin\v1\ProfileController@password');
        Route::group(['/profile'], function(){
            Route::get("", '\App\Http\Controllers\Api\Admin\v1\ProfileController@index');
        });

        Route::post("/tags", '\App\Http\Controllers\Api\Admin\v1\TagController@store');
        Route::get("/tags", '\App\Http\Controllers\Api\Admin\v1\TagController@index');
        Route::get("/tags/{id}", '\App\Http\Controllers\Api\Admin\v1\TagController@view');
    });
});


//Customer APIs
Route::prefix('/customer/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Customer\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Customer\v1\LoginController@index');


    Route::group(['middleware' =>[ 'jwt.auth','customer.authenticator']], function(){
        Route::post('/forgot-password', '\App\Http\Controllers\Api\Customer\v1\ProfileController@password');
        Route::get("/challenges", '\App\Http\Controllers\Api\Customer\v1\ChallengeController@index');
        Route::get("/challenges/{id}", '\App\Http\Controllers\Api\Customer\v1\ChallengeController@view');
        Route::get("/challenges/{'}/tricks", '\App\Http\Controllers\Api\Customer\v1\ChallengeController@tricks');
        Route::post("/challenges/{challenge_id}/tricks", '\App\Http\Controllers\Api\Customer\v1\TrickController@store');
    });
});

//Brand APIs
Route::prefix('/brand/v1/')->group(function () {
    Route::post('/signup', '\App\Http\Controllers\Api\Brand\v1\SignupController@register');
    Route::post('/login', '\App\Http\Controllers\Api\Brand\v1\LoginController@index');

    Route::group(['middleware' =>[ 'jwt.auth','brand.authenticator']], function(){
        Route::post('/forgot-password', '\App\Http\Controllers\Api\Brand\v1\ProfileController@password');
        Route::post('/profile', '\App\Http\Controllers\Api\Brand\v1\ProfileController@image');
        Route::get("/profile", '\App\Http\Controllers\Api\Brand\v1\ProfileController@index');
        Route::post("/challenges", '\App\Http\Controllers\Api\Brand\v1\ChallengeController@store');
        Route::get("/challenges", '\App\Http\Controllers\Api\Brand\v1\ChallengeController@index');
        Route::get("/challenges/{id}", '\App\Http\Controllers\Api\Brand\v1\ChallengeController@view');
    });
});


/**
 *
 */
Route::fallback(function(Request $request){
    return response()->json(['message' => 'Route Not Found.', 'route' => $request->getRequestUri()], 404);
})->name('api.fallback.404');
