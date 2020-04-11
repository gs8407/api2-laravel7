<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');
Route::post('/refreshtoken', 'API\UserController@refreshToken');
Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'API\ResetPasswordController@reset');

Route::get('unauthorized', 'UserController@unauthorized');

Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/logout', 'API\UserController@logout');
    Route::post('/details', 'API\UserController@details');
    Route::get('/SafetyAndSecurity', 'API\SafetySecurityController@show');
    Route::get('/Eula', 'API\EulaController@show');
    Route::put('/Eula', 'API\EulaController@update');
    Route::get('/UserInfo', 'API\UserInfoController@show');
});
