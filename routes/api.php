<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('test-concurrency-1', [App\Http\Controllers\TestController::class, 'testConcurrency1']);
Route::get('test-concurrency-2', [App\Http\Controllers\TestController::class, 'testConcurrency2']);
Route::get('test-redis', [App\Http\Controllers\TestController::class, 'testRedis']);