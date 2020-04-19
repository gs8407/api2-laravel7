<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/eula', 'EulaController@index')->name('eula');
Route::put('/eula', 'EulaController@store')->name('eula');

Route::get('/safety-security', 'SafetySecurityController@index')->name('safety_security');
Route::put('/safety-security', 'SafetySecurityController@store')->name('safety_security');

Route::get('/required-version', 'RequiredAppVersionController@index')->name('required_version');
Route::put('/required-version', 'RequiredAppVersionController@store')->name('required_version');

Auth::routes();
