<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\TrucksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



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
            Route::get('import_form','ImportForm')->name('trucks.import_form');
            Route::get('export','export')->name('trucks.export');
            Route::post('import', 'import')->name('trucks.import');
        });
        
        
        Route::prefix('drivers')->controller(DriversController::class)->group(function () {
            Route::get('index', 'index')->name('drivers.index');
            Route::get('create', 'create')->name('drivers.create');
            Route::post('store', 'store')->name('drivers.store');
            Route::get('edit/{id}', 'edit')->name('drivers.edit');
            Route::post('update/{id}', 'update')->name('drivers.update');
            Route::delete('bulk-delete', 'MultiDelete')->name('drivers.bulk-delete');
            Route::delete('delete/{id}','destroy')->name('drivers.delete');
            Route::get('import_form','ImportForm')->name('drivers.import_form');
            Route::get('export','export')->name('drivers.export');
            Route::post('import', 'import')->name('drivers.import');
        
        });

    });
    
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('index', 'index')->name('users.index');
        Route::get('create', 'create')->name('users.create');
        Route::post('store', 'store')->name('users.store');
        Route::get('edit/{id}', 'edit')->name('users.edit');
        Route::post('update/{id}', 'update')->name('users.update');
        Route::delete('bulk-delete', 'MultiDelete')->name('users.bulk-delete');
        Route::delete('delete/{id}','destroy')->name('users.delete');
        Route::get('import_form','ImportForm')->name('users.import_form');
        
        Route::get('export','export')->name('users.export');
        Route::post('import', 'import')->name('users.import');
    });