<?php

use App\Http\Controllers\DriversController;
use App\Http\Controllers\TrucksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('trucks')->group(function () {
    Route::get('index', [TrucksController::class, 'index'])->name('trucks.index');
    Route::get('create', [TrucksController::class, 'create'])->name('trucks.create');
    Route::post('store', [TrucksController::class, 'store'])->name('trucks.store');
    Route::delete('delete_all',[TrucksController::class,'MultiDelete'])->name('trucks.delete_all');
});

Route::prefix('drivers')->group(function () {
    Route::get('index', [DriversController::class, 'index'])->name('drivers.index');
    Route::get('create', [DriversController::class, 'create'])->name('drivers.create');
    Route::post('store', [DriversController::class, 'store'])->name('drivers.store');
    Route::post('bulk-delete', [DriversController::class, 'bulkDelete'])->name('drivers.bulkDelete');
    Route::delete('delete_all',[DriversController::class,'MultiDelete'])->name('drivers.delete_all');

});
