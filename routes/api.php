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


Route::post('login', 'Auth\AuthenticateControllerLogin@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateControllerLogin@refreshToken');
Route::get('me', 'Auth\AuthenticateControllerLogin@getAuthenticatedUser');

Route::apiResource('User', 'Api\UserController');
Route::apiResource('Colaborador', 'Api\ColaboradorApiController');

Route::get('Colaborador/{id}/SearchCpf', 'Api\ColaboradorApiController@getsearchCpf');
Route::post('Colaborador/{id}/vincularSalario', 'Api\ColaboradorApiController@vincularSalario');
Route::get('Colaborador/{id}/salario', 'Api\ColaboradorApiController@salario');

