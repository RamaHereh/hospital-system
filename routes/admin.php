<?php
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\Services\IndividualController;
use App\Http\Controllers\Admin\Services\InsuranceController;
use App\Http\Controllers\Admin\Services\AmbulanceController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\RayEmpController;
use App\Http\Controllers\Admin\LaboratoryEmpController;
use App\Http\Livewire\IndividualInvoices;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/404', function () {
    return view('Dashboard.404');
})->name('404');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    
        Route::get('dashboard', function () {
            return view('dashboard.admin.dashboard');
        })->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

        Route::resource('sections', SectionController::class);

        Route::resource('doctors', DoctorController::class);
        Route::post('update_password', [DoctorController::class, 'updatePassword'])->name('update.password');
        Route::post('update_status', [DoctorController::class, 'updateStatus'])->name('update.status');

        Route::resource('individual_services', IndividualController::class);
        Route::view('group_services','livewire.group_services.include_create')->name('group_services');
        Route::resource('ambulances', AmbulanceController::class);
        Route::resource('insurance_companies', InsuranceController::class);

        Route::resource('patients', PatientController::class);

        Route::view('individual_invoices','livewire.individual_invoices.index')->name('individual_invoices');
        Route::view('print_individual_invoices','livewire.individual_invoices.print')->name('print_individual_invoices');
        Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');
        Route::view('print_group_invoices','livewire.group_invoices.print')->name('print_group_invoices');

        Route::resource('receipts', ReceiptController::class);

        Route::resource('ray-emps', RayEmpController::class);

        Route::resource('laboratory-emps', LaboratoryEmpController::class);
});


require __DIR__.'/auth.php';
    });


