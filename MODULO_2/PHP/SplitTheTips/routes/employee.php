<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

// Rutas para usuarios con rol "employee"
Route::middleware(['auth', 'checkRole:employee'])->prefix('employee')->name('employee.')->group(function () {
    // Dashboard y perfil
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');

    // Propinas
    Route::get('/my-tips', [EmployeeController::class, 'showMyTips'])->name('my-tips');

    // Invitaciones
    Route::post('accept-invitation/{invitation}', [EmployeeController::class, 'acceptInvitation'])->name('accept-invitation');
    Route::post('reject-invitation/{invitation}', [EmployeeController::class, 'rejectInvitation'])->name('reject-invitation');
});
