<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

// Root Route: Redirects authenticated users to dashboard and guests to login
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::get('/transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/{id}', [TransactionController::class, 'show'])
        ->name('transactions.show');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    Route::get('/transactions/{id}/edit', [
    TransactionController::class,
    'edit'
    ])->name('transactions.edit');

    Route::put('/transactions/{id}', [
        TransactionController::class,
        'update'
    ])->name('transactions.update');

    Route::delete('/transactions/{id}', [
        TransactionController::class,
        'destroy'
    ])->name('transactions.destroy');
    
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    // Budget Management Routes
    Route::resource('budgets', BudgetController::class)
        ->except(['show']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');
    Route::post('/settings/clear-data', [SettingsController::class, 'clearData'])
        ->name('settings.clear-data');
});