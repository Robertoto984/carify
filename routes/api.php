<?php

use App\Http\Controllers\DriversController;
use App\Http\Controllers\TrucksController;
use App\Http\Middleware\RedirectMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


