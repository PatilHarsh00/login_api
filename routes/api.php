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

Route::get('login', 'PassportController@login');
Route::get('register', 'PassportController@register');
//app\Http\Controllers\PassportController@register
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@register@details');

 
    Route::resource('logins', 'LoginController');
});