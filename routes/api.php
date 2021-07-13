<?php

use App\Http\Controllers\Api\V1\ProcessController;
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

Route::apiResource('v1/process', ProcessController::class);
Route::post('v1/process/{uuid}/start', [ProcessController::class, 'start']);
Route::post('v1/process/{uuid}/finished', [ProcessController::class, 'finished']);
