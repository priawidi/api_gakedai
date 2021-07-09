<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\MenuResource;
use App\Http\Resources\GoogleUserResource;
use App\Models\Menu;
use App\Models\GoogleUser;

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

Route::apiResource('menu', 'MenuController');
Route::apiResource('google', 'GoogleUserController');

Route::get('/menu/{id}', function($id){
    return new MenuResource(Menu::findOrFail($id));
});