<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\EscortController;
use App\Http\Controllers\MovementCommandController;
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

        Route::prefix('cards')->controller(CardsController::class)->group(function () {
            Route::get('index', 'index')->name('cards.index');
            Route::get('create/{id}', 'create')->name('trucks.create-deliver-order');
            Route::post('store', 'store')->name('trucks.store-deliver-order');
        });


        Route::prefix('commands')->controller(MovementCommandController::class)->group(function () {
            Route::get('index', 'index')->name('commands.index');
            Route::get('create', 'create')->name('commands.create');
            Route::post('store', 'store')->name('commands.store');
            Route::get('edit/{id}', 'edit')->name('commands.edit');
            Route::post('update/{id}', 'update')->name('commands.update');
            Route::get('finish/{id}', 'finish')->name('commands.finish');
            Route::post('complete/{id}', 'complete')->name('commands.complete');
            Route::delete('bulk-delete', 'MultiDelete')->name('commands.bulk-delete');
            Route::delete('delete/{id}', 'destroy')->name('commands.delete');
            Route::get('import_form', 'ImportForm')->name('commands.import_form');
            Route::get('export', 'export')->name('commands.export');
            Route::post('import', 'import')->name('commands.import');
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

        Route::prefix('escorts')->controller(EscortController::class)->group(function () {
            Route::get('index', 'index')->name('escorts.index');
            Route::get('create', 'create')->name('escorts.create');
            Route::post('store', 'store')->name('escorts.store');
            Route::get('edit/{id}', 'edit')->name('escorts.edit');
            Route::post('update/{id}', 'update')->name('escorts.update');
            Route::delete('delete/{id}','destroy')->name('escorts.delete');
            Route::delete('bulk-delete', 'MultiDelete')->name('escorts.bulk-delete');
            Route::get('import_form','ImportForm')->name('escorts.import_form');
            Route::get('export','export')->name('escorts.export');
            Route::post('import', 'import')->name('escorts.import');
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