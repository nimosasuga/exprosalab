<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\SubscriptionController; // <-- 1. Tambahkan Controller baru kita di sini
use Illuminate\Support\Facades\Route;

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
| Authenticated Routes (General)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Business Evaluation Start Page
    Route::get('/evaluation', function () {
        return view('evaluation');
    })->name('evaluation.index');

    // Results
    Route::get('/results', function () {
        return view('results');
    })->name('results.index');

    // Insights
    Route::get('/insights', function () {
        return view('insights');
    })->name('insights.index');

    // --- 2. PERUBAHAN RUTE SUBSCRIPTION & CHECKOUT ---
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    // --------------------------------------------------

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Premium Routes (Evaluation Engine)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:premium'])->group(function () {
    Route::get('/premium', function () {
        return view('premium.dashboard');
    })->name('premium.dashboard');

    // Wizard Routes
    Route::post('/evaluation/init', [EvaluationController::class, 'initWizard'])->name('evaluation.init');
    Route::get('/evaluation/step/{step}', [EvaluationController::class, 'showStep'])->name('evaluation.step');
    Route::post('/evaluation/step/{step}', [EvaluationController::class, 'saveStep'])->name('evaluation.saveStep');
    Route::get('/evaluation/result/{id}', [EvaluationController::class, 'result'])->name('evaluation.result');
    Route::get('/results', [EvaluationController::class, 'indexResults'])->name('results.index');
    Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/questions', function () {
        return view('admin.questions');
    })->name('questions');

    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('analytics');
});

require __DIR__ . '/auth.php';
