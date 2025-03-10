<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('blogs', BlogController::class);

// SoftDelete routes
Route::get('blogs/trashed', [BlogController::class, 'trashed']);
Route::post('blogs/restore/{id}', [BlogController::class, 'restore']);
Route::delete('blogs/force-delete/{id}', [BlogController::class, 'forceDelete']);



