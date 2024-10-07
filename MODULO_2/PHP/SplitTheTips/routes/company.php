<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkShiftController;
use App\Http\Controllers\TipPoolController;

// Rutas para usuarios con rol "company"
Route::middleware(['auth', 'checkRole:company'])->prefix('company')->name('company.')->group(function () {
    // Dashboard y perfil
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CompanyController::class, 'profile'])->name('profile');
    Route::put('/profile', [CompanyController::class, 'updateProfile'])->name('update-profile');
    Route::resource('work_shifts', WorkShiftController::class);
    Route::get('work-shifts/create', [WorkShiftController::class, 'create'])->name('work_shifts.create');
    Route::get('/work-shifts', [WorkShiftController::class, 'index'])->name('work_shifts.index');
    Route::resource('tip_pools', TipPoolController::class);


    // Empleados
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employees/invite', [EmployeeController::class, 'inviteForm'])->name('employees.invite');
    Route::post('/invite', [EmployeeController::class, 'sendInvite'])->name('invite.send');
    Route::get('/invite', [CompanyController::class, 'inviteForm'])->name('invite.form');
    Route::post('/invitations', [CompanyController::class, 'storeInvitation'])->name('invitations.store');
    Route::get('/work-shifts/create', [WorkShiftController::class, 'create'])->name('work_shifts.create');
    
    // Áreas
    Route::resource('areas', AreaController::class)->except(['destroy']);
    Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');
    
    // Cálculo de propinas
    Route::get('/calculate-tips', [CompanyController::class, 'calculateTips'])->name('calculate-tips');
    Route::post('/calculate-tips', [CompanyController::class, 'calculateTipsPost'])->name('calculate-tips-post');
    Route::get('/tips-history', [TipController::class, 'history'])->name('tips-history');
    Route::post('/tip-pools/{tipPool}/distribute', [TipPoolController::class, 'distribute'])->name('tip_pools.distribute');
    Route::get('/register-daily-tips', [CompanyController::class, 'registerDailyTips'])->name('register-daily-tips');
    Route::get('/tip-pools', [TipPoolController::class, 'index'])->name('tip_pools.index');
    Route::get('/tip-pools/create', [TipPoolController::class, 'create'])->name('tip_pools.create');
    Route::get('/tip-distribution', [CompanyController::class, 'showTipDistribution'])->name('tip_distribution');
    Route::post('/tip-pools', [TipPoolController::class, 'store'])->name('tip_pools.store');
    Route::get('/register-daily-tips', [CompanyController::class, 'showRegisterDailyTipsForm'])->name('register-daily-tips');
    Route::post('/register-daily-tips', [CompanyController::class, 'registerDailyTips'])->name('register-daily-tips');
    Route::post('/store-daily-tips', [CompanyController::class, 'storeDailyTips'])->name('store-daily-tips');
    
    // Reportes
    Route::get('/reports', [CompanyController::class, 'reports'])->name('reports');
    Route::get('/monthly-report', [CompanyController::class, 'monthlyReport'])->name('monthly-report');

    // Configuración
    Route::get('/settings', [CompanyController::class, 'settings'])->name('settings');
    Route::put('/settings', [CompanyController::class, 'updateSettings'])->name('update-settings');

    // Rutas adicionales
    //Route::resource('shifts', ShiftController::class);
    Route::get('/employee-performance', [CompanyController::class, 'employeePerformance'])->name('employee-performance');
});
