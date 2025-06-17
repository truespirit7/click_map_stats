<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiteController as SiteController;
use App\Http\Controllers\Api\ClickController as ClickController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::apiResource('sites', SiteController::class)->names('api.sites');

Route::apiResource('clicks', ClickController::class)->names('api.clicks');


Route::get('sites/{site}/activity', [SiteController::class, 'activity'])
    ->name('api.sites.activity');

Route::get('sites/{site}/clickmap', [SiteController::class, 'clickMap'])
    ->name('api.sites.clickmap');
