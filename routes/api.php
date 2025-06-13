<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiteController as SiteController;
use App\Http\Controllers\Api\ClickController as ClickController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('sites', SiteController::class);
Route::resource('clicks', ClickController::class);