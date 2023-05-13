<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//get interest list
Route::get('interests','InterestController@index');
//user register 
Route::post('account','AccountController@register');
//verify email
Route::get('email/verify/{id}', 'AccountController@verify')->name('verification.verify'); // Make sure to keep this as your route name

//create token
Route::post('login','AccountController@issueToken');

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::group(['namespace' => 'User'],function ()
    {
        //get user profile
        Route::get('profile','UserController@profile');
        //other routes can be written below
    });
   //account logout
    Route::post('account/logout','AccountController@accountLogout');
});