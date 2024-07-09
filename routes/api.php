<?php

use App\Http\Controllers\BiodataController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/biodata', [BiodataController::class, 'get'])->middleware('token');
Route::post('/biodata', [BiodataController::class, 'create'])->middleware('token');
Route::put('/biodata', [BiodataController::class, 'update'])->middleware('token');