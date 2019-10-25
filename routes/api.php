<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/cadastrar',  ['uses' => 'Controller@cadastrar']);

Route::post('/entrar',  ['uses' => 'Controller@entrar']);

Route::post('/salvartweet',  ['uses' => 'Controller@salvartweet']);

Route::post('/carregarfeed',  ['uses' => 'Controller@carregarfeed']);

Route::post('/salvarcomenatrio',  ['uses' => 'Controller@salvarcomenatrio']);

Route::post('/carregarcomentarios',  ['uses' => 'Controller@carregarcomentarios']);

Route::post('/seguir',  ['uses' => 'Controller@seguir']);