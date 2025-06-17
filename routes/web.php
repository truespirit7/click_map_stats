<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('sites/index');
    return view('welcome');
});

Route::get('/sites', function () {
    return view('sites.index');
});
Route::get('/sites/{id}/activity', [App\Http\Controllers\SiteController::class, 'activity'])->name('sites.activity');
Route::get('/sites/{id}/clickmap', [App\Http\Controllers\SiteController::class, 'clickMap'])->name('sites.clickmap');