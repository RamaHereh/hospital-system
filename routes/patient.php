<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Patient\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| patient Routes
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


Route::prefix('patient')->middleware(['auth:patient'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.patient.dashboard');
    })->name('patient.dashboard');


    Route::get('invoices', [PatientController::class,'invoices'])->name('invoices.patient');
    Route::get('laboratories', [PatientController::class,'laboratories'])->name('laboratories.patient');
    Route::get('laboratories/{id}', [PatientController::class,'viewLaboratories'])->name('laboratories.view');
    Route::get('rays', [PatientController::class,'rays'])->name('rays.patient');
    Route::get('rays/{id}', [PatientController::class,'viewRays'])->name('rays.view');
    Route::get('payments', [PatientController::class,'payments'])->name('payments.patient');

});

require __DIR__.'/auth.php';
    });


