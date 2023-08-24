<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\LaboratoryEmpController;
use App\Http\Controllers\Auth\RayEmpController;
use App\Http\Controllers\Auth\PatientController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('user/login', [AuthenticatedSessionController::class, 'store'])->name('user.login');

    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');

    Route::post('doctor/login', [DoctorController::class, 'store'])->name('doctor.login');

    Route::post('patient/login', [PatientController::class, 'store'])->name('patient.login');

    Route::post('laboratory-emp/login', [LaboratoryEmpController::class, 'store'])->name('laboratory-emp.login');

    Route::post('ray-emp/login', [RayEmpController::class, 'store'])->name('ray-emp.login');


    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('user/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('user.logout');

    
});

Route::post('admin/logout', [AdminController::class, 'destroy'])->middleware('auth:admin')
                ->name('admin.logout');

Route::post('doctor/logout', [DoctorController::class, 'destroy'])->middleware('auth:doctor')
->name('doctor.logout');

Route::post('patient/logout', [PatientController::class, 'destroy'])->middleware('auth:patient')
                ->name('patient.logout');

Route::post('ray-emp/logout', [RayEmpController::class, 'destroy'])->middleware('auth:ray_emp')
->name('ray-emp.logout');

Route::post('laboratory-emp/logout', [LaboratoryEmpController::class, 'destroy'])->middleware('auth:laboratory_emp')
->name('laboratory-emp.logout');


