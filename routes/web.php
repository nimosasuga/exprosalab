<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (General) - BISA DIAKSES PENGGUNA GRATIS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Business Evaluation Start Page
    Route::get('/evaluation', function () {
        return view('evaluation');
    })->name('evaluation.index');

    // --- RUTE EVALUASI (WIZARD) PINDAH KE SINI ---
    Route::post('/evaluation/init', [EvaluationController::class, 'initWizard'])->name('evaluation.init');
    Route::get('/evaluation/step/{step}', [EvaluationController::class, 'showStep'])->name('evaluation.step');
    Route::post('/evaluation/step/{step}', [EvaluationController::class, 'saveStep'])->name('evaluation.saveStep');
    Route::get('/evaluation/result/{id}', [EvaluationController::class, 'result'])->name('evaluation.result');
    Route::get('/results', [EvaluationController::class, 'indexResults'])->name('results.index');
    // ----------------------------------------------

    // Subscription & Checkout
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Premium Routes - HANYA UNTUK PENGGUNA BERBAYAR (PRO)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:premium'])->group(function () {

    // Halaman khusus member Pro
    Route::get('/premium', function () {
        return view('premium.dashboard');
    })->name('premium.dashboard');

    // --- BUSINESS INSIGHTS DIKUNCI DI SINI ---
    Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users');
    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/questions', function () {
        return view('admin.questions');
    })->name('questions');

    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('analytics');
});

require __DIR__ . '/auth.php';
