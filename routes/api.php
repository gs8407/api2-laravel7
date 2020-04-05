<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'API\AccessTokenController@issueToken');
Route::post('/register', 'API\UserController@register');
Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'API\ResetPasswordController@reset');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/SafetyAndSecurity', 'API\SafetyAndSecurityController@show');
    Route::get('/Eula', 'API\EulaController@show');
    Route::put('/Eula', 'API\EulaController@update');
    Route::get('/UserInfo', 'API\UserInfoController@show');
});
