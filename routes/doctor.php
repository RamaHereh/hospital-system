<?php
use App\Http\Controllers\Doctor\DiagnosisController;
use App\Http\Controllers\Doctor\LaboratoryController;
use App\Http\Controllers\Doctor\RayController;
use App\Http\Controllers\doctor\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| dactor Routes
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

        Route::prefix('doctor')->middleware(['auth:doctor'])->group(function () {

            Route::get('dashboard', function () {
                return view('dashboard.doctor.dashboard');
            })->name('doctor.dashboard');
        
            Route::get('/invoices/in-process', [InvoiceController::class,'inProcessInvoices'])->name('inProcess.invoices');
            Route::get('/invoices/completed', [InvoiceController::class,'completedInvoices'])->name('completed.invoices');
            Route::get('/invoices/reviewed', [InvoiceController::class,'reviewedInvoices'])->name('reviewed.invoices');
            Route::get('/patient-details/{id}', [InvoiceController::class,'patientDetails'])->name('patient.details');
        
            Route::post('add-review', [DiagnosisController::class,'addReview'])->name('add.review');
            Route::resource('diagnoses', DiagnosisController::class);
        
            Route::resource('doctor-rays', RayController::class);
        
            Route::resource('doctor-laboratories', LaboratoryController::class);
        
        });

        require __DIR__.'/auth.php';
    });


