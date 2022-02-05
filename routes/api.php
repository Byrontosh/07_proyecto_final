<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\WardController;
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

// https://laravel.com/docs/8.x/controllers#resource-controllers

// Route::resource('wards', WardController::class);

//php artisan route:list --compact
// php artisan route:list --compact --path=api
// Route::get('/wards',[WardController::class,'index']);
// Route::post('/wards',[WardController::class,'store']);
// Route::get('/wards/{ward}',[WardController::class,'show']);
// Route::put('/wards/{ward}',[WardController::class,'update']);
// Route::delete('/wards/{ward}',[WardController::class,'destroy']);

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/reports', [ReportController::class, 'list_reports']);
Route::get('/wards', [WardController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function ()
{
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/wards', [WardController::class, 'store']);
    Route::get('/wards/{ward}', [WardController::class, 'show']);
    Route::put('/wards/{ward}', [WardController::class, 'update']);
    Route::delete('/wards/{ward}', [WardController::class, 'destroy']);

    //test
    Route::get('/users/{user}', [WardController::class, 'user_show']);

});
