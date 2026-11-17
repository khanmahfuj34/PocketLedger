<?php

use App\Http\Controllers\aboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PracticeProductController;

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

// OpenAPI Direct Specification Routes
Route::get('/docs/api-docs.json', function () {
    $path = storage_path('api-docs/api-docs.json');
    if (! file_exists($path)) {
        abort(404, 'API documentation not yet generated.');
    }
    return response(file_get_contents($path), 200, ['Content-Type' => 'application/json']);
});

Route::get('/docs/api-docs.yaml', function () {
    $path = storage_path('api-docs/api-docs.yaml');
    if (! file_exists($path)) {
        abort(404, 'API YAML documentation not yet generated.');
    }
    return response(file_get_contents($path), 200, ['Content-Type' => 'application/x-yaml']);
});

/////////////////////////////////////////////////////////
//Laravel Routing Practice
////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////



Route::get('/practice/hello', function () {
    return 'Hello From Laravel';
});

Route::get('/practice/about', function () {
    return 'I am learning Laravel Routing.';
});
Route::get('/practice/product/{id}', function ($id) {
    return 'You are watching product with ID: ' . $id;
});

Route::get('/practice/student/{name}', function ($name) {
    return "Student Name: {$name}";
});

Route::get('/practice/greeting/{name?}', function ($name = 'Guest') {
    return "Hello, {$name}!";
});

Route::get('/practice/about', function () {
    return 'I am learning Laravel Routing.';
})->name('practice.about');

Route::prefix('practice')->name('practice.')->group(function () {
    Route::get('/dashboard', function () {
        return 'Practice Dashboard';
    })->name('dashboard');
    Route::get('/profile', function () {
        return 'Practice Profile';
    })->name('profile');
});

///////////////////////
//Practice Controller
///////////////////////
Route:: get('/practice/controller/student/{name}', [PracticeController::class, 'student'])->name('practice.controller.student');

Route::get('/practice/about', [aboutController::class, 'index'])->name('practice.about');

Route::get('/practice/request', [
    PracticeController::class,
    'requestInfo'
])->name('practice.request');

Route::get('/practice/request/all', [PracticeController::class, 'allRequestData'])->name('practice.request.all');

Route::get('/practice/user/profile', [PracticeController::class, 'useProfile'])->name('practice.user.profile');

Route::get('/practice/form', [
    PracticeController::class,
    'showForm'
])->name('practice.form');

Route::post('/practice/form/submit', [
    PracticeController::class,
    'submitForm'
])->name('practice.form.submit');

Route::get('/practice/products', [
    PracticeProductController::class,
    'index'
]);

Route::get('/practice/products/{id}', [
    PracticeProductController::class,
    'show'
]);