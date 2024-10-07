<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TipPoolController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\EmployeeInvitationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Rutas públicas
Route::view('/', 'welcome')->name('home');
Route::view('/about', 'about');
Route::view('/faq', 'faq');
Route::view('/terms', 'terms');
Route::view('/privacy', 'privacy');
Route::view('/features', 'features');

// Rutas de autenticación
Auth::routes(['verify' => true]);

// Rutas para invitados (sin autenticación)
Route::middleware('guest')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register-invited-employee', [EmployeeController::class, 'registerInvitedEmployee'])->name('register.invited.employee');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Ruta para empleados invitados (accesible sin autenticación)
Route::get('/accept-invitation/{token}', [EmployeeInvitationController::class, 'acceptInvitation'])->name('invitation.accept');
Route::post('/accept-invitation/{token}', [EmployeeInvitationController::class, 'processAcceptInvitation'])->name('invitation.process');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta para cerrar sesión
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rutas de notificaciones
    Route::post('/company/send-invite', [CompanyController::class, 'sendInvite'])->name('company.send-invite');
    Route::post('/employee/accept-invitation/{invitation}', [EmployeeController::class, 'acceptInvitation'])->name('employee.accept-invitation');
    Route::post('/employee/reject-invitation/{invitation}', [EmployeeController::class, 'rejectInvitation'])->name('employee.reject-invitation');

    // Ruta calculo de propina
    Route::post('/tip-pools/{tipPool}/distribute', [TipPoolController::class, 'distribute'])->name('company.tip_pools.distribute');

    // Rutas de verificación de email
    Route::prefix('email')->group(function () {
        Route::get('/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    });

    // Rutas de perfil (disponible para todos los roles)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Modularización de rutas para diferentes roles
    require __DIR__.'/company.php';
    require __DIR__.'/employee.php';

});
