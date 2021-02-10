<?php

use App\Http\Controllers\API\RegisterController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function () {
    Route::resource('backends', 'BackendAPIController');
});

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [RegisterController::class, 'login']);

//Route::resource('backends', 'BackendAPIController');

Route::resource('public', 'RawPublicAPIController');

Route::resource('brand_name', 'BrandNameAPIController');

Route::resource('image', 'ImageController');

Route::resource('slider', 'SliderController');





Route::resource('publics', App\Http\Controllers\API\PublicAPIController::class);


Route::resource('raw_publics', App\Http\Controllers\API\RawPublicAPIController::class);


Route::resource('brand_names', App\Http\Controllers\API\BrandNameAPIController::class);
