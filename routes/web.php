<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Section;
use App\Models\Doctor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

        Route::get('/', function () {
            $sections = Section::get();
            $doctors = Doctor::take(4)->get();
            
            return view('welcome', ['sections' => $sections ,'doctors' => $doctors]);
        })->name('welcome');

        Route::get('/doctors', function () {
            $doctors = Doctor::get();
            
            return view('website.doctors', ['doctors' => $doctors]);
        })->name('website.doctors');

        Route::get('/sections', function () {
            $sections = Section::get();

            
            return view('website.sections', ['sections' => $sections ]);
        })->name('website.sections');
        

});








