<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaboratoryEmp\LaboratoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| laboratory_emp Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::prefix('laboratory-emp')->middleware(['auth:laboratory_emp'])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard.laboratory_emp.dashboard');
        })->name('laboratory_emp.dashboard');
        
        Route::get('/laboratories/completed', [LaboratoryController::class,'completedLabs'])->name('laboratories.completed');
        Route::resource('laboratories', LaboratoryController::class);
        

    });

require __DIR__.'/auth.php';
    });


