<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\TrucksController;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware'=>'api'],function(){
    Route::get('/', function () {
        return view('login');
    });
    
    Route::post('login',[AuthController::class, 'login'])->name('login');
    
    Route::group(['middleware'=>'redirect'],function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
        Route::prefix('trucks')->controller(TrucksController::class)->group(function () {
            Route::get('index', 'index')->name('trucks.index');
            Route::get('create', 'create')->name('trucks.create');
            Route::post('store', 'store')->name('trucks.store');
            Route::get('edit/{id}', 'edit')->name('trucks.edit');
            Route::post('update/{id}', 'update')->name('trucks.update');
            Route::delete('bulk-delete', 'MultiDelete')->name('trucks.bulk-delete');
            Route::delete('delete/{id}', 'destroy')->name('trucks.delete');
        });
        
        
        Route::prefix('drivers')->controller(DriversController::class)->group(function () {
            Route::get('index', 'index')->name('drivers.index');
            Route::get('create', 'create')->name('drivers.create');
            Route::post('store', 'store')->name('drivers.store');
            Route::get('edit/{id}', 'edit')->name('drivers.edit');
            Route::post('update/{id}', 'update')->name('drivers.update');
            Route::delete('bulk-delete', 'MultiDelete')->name('drivers.bulk-delete');
            Route::delete('delete/{id}','destroy')->name('drivers.delete');
        
        });
    });
    
// });