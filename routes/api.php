<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TypeController;
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

//Route::prefix('schedule')->group( function () {
//    Route::get('/' , [ScheduleController::class,'index']);
//    //Route::get('schedule/{schedule}' , [ScheduleController::class,'show'])->middleware('auth:sanctum');
//    Route::post('/' , [ScheduleController::class,'store']);
//    Route::put('/{schedule}' , [ScheduleController::class,'edit']);
//    Route::delete('/{schedule}' , [ScheduleController::class,'destroy']);
//});

Route::prefix('auth')->group( function () {
    Route::post('/register' , [LoginController::class,'register']);
    Route::post('/login' , [LoginController::class,'login']);
    Route::post('/logout' , [LoginController::class,'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'type', 'middleware' => ['auth:sanctum']], function(){
    Route::get('/' , [TypeController::class,'index']);
    Route::get('/{type}' , [TypeController::class,'show']);
    Route::post('/' , [TypeController::class,'store']);
    Route::put('/{type}' , [TypeController::class,'edit']);
    Route::delete('/{type}' , [TypeController::class,'destroy']);
});

Route::group(['prefix' => 'schedule', 'middleware' => ['auth:sanctum']], function(){
    Route::get('/' , [ScheduleController::class,'index']);
    Route::get('schedule/{schedule}' , [ScheduleController::class,'show'])->middleware('auth:sanctum');
    Route::post('/' , [ScheduleController::class,'store']);
    Route::put('/{schedule}' , [ScheduleController::class,'edit']);
    Route::delete('/{schedule}' , [ScheduleController::class,'destroy']);
});

Route::middleware('auth:sanctum')->get('/schedule', function (Request $request) {
    return $request->user();
});
