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

Route::post('register', [\App\Http\Controllers\API\RegisterAPIController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\RegisterAPIController::class, 'login']);

Route::get('customers/list',[\App\Http\Controllers\API\CustomerAPIController::class,'index']);
Route::get('customers/search',[\App\Http\Controllers\API\CustomerAPIController::class,'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::resource('customers',\App\Http\Controllers\API\CustomerAPIController::class);
});
