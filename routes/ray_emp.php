<?php
use App\Http\Controllers\RayEmp\RayController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ray_emp Routes
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

        Route::prefix('ray-emp')->middleware(['auth:ray_emp'])->group(function () {

            Route::get('dashboard', function () {
              return view('dashboard.ray_emp.dashboard');
            })->name('ray-emp.dashboard');

            Route::get('/rays/completed', [RayController::class,'completedRays'])->name('rays.completed');
            Route::resource('rays', RayController::class);
            
        });
require __DIR__.'/auth.php';
    });


