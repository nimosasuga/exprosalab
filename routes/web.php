<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DashboardController;
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

    // Dashboard - Menggunakan Controller agar lebih rapi
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

    // Subscription
    Route::get('/subscription', function () {
        return view('subscription');
    })->name('subscription.index');

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

    // Logika pengisian evaluasi
    Route::get('/evaluation/start', [EvaluationController::class, 'start'])->name('evaluation.start');
    Route::post('/evaluation/store', [EvaluationController::class, 'store'])->name('evaluation.store');
    Route::get('/evaluation/result/{id}', [EvaluationController::class, 'result'])->name('evaluation.result');
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

require __DIR__.'/auth.php';
