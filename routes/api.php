<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\SocialController;
use App\Http\Resources\GoogleUserResource;
use App\Http\Resources\AuthUserGoogleresource;
use App\Models\Menu;
use App\Models\GoogleUser;
use App\Models\AuthUserGoogle;

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

// Route::post('login', [SocialController::class, 'login']);
// Route::post('register', [SocialController::class, 'register']);
// Route::get('loginfalse/{msg}', [SocialController::class, 'loginfalse']);

// Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);


Route::apiResource('menu', 'MenuController');
Route::post('token', 'MenuController@tokensignin');
Route::get('filter/{type}', 'MenuController@filter');
Route::apiResource('google', 'GoogleUserController');
Route::apiResource('cart', 'CartController');
// Route::get('cart','CartController@index');
// Route::get('cart/{cart}','CartController@show');
// Route::post('cart','CartController@store');
// Route::put('cart/{cart}','CartController@update');
// Route::delete('cart','CartController@update');

Route::get('/menu/{id}', function($id){
    return new MenuResource(Menu::findOrFail($id));
});

// Route::group(['middleware' => 'auth:api'], function(){
// 	Route::get('details', [SocialController::class, 'details']);
//Route::post('tokensignin', 'SocialController@tokensignin');

// });