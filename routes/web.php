<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AnalyticsController;

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

    // Business Evaluation Hub
    Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation.index');

    // Wizard Evaluasi
    Route::post('/evaluation/init', [EvaluationController::class, 'initWizard'])->name('evaluation.init');
    Route::get('/evaluation/step/{step}', [EvaluationController::class, 'showStep'])->name('evaluation.step');
    Route::post('/evaluation/step/{step}', [EvaluationController::class, 'saveStep'])->name('evaluation.saveStep');
    Route::get('/evaluation/result/{id}', [EvaluationController::class, 'result'])->name('evaluation.result');
    Route::get('/results', [EvaluationController::class, 'indexResults'])->name('results.index');
    Route::delete('/evaluation/{id}', [EvaluationController::class, 'destroy'])->name('evaluation.destroy');

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
| Premium Routes - HANYA UNTUK PENGGUNA BERBAYAR (PRO) ATAU ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:premium'])->group(function () {

    Route::get('/premium', function () {
        return view('premium.dashboard');
    })->name('premium.dashboard');

    Route::get('/insights/{id?}', [InsightController::class, 'index'])->name('insights.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Manajemen Pertanyaan (Sudah Menggunakan Resource)
    Route::resource('questions', QuestionController::class)->except(['show']);

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
});

require __DIR__ . '/auth.php';
