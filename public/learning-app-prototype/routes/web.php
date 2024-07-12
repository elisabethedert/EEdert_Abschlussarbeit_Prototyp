<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LectureOverviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionResultsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// start page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// dashboard with units
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// profile page
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// lecture overview
Route::get('unit{unit}/lektionen',[LectureOverviewController::class, 'index'])->middleware(['auth', 'verified']);

// lecture with questions
Route::get('unit1/lektion{lecture}',[LectureController::class, 'index'])->middleware(['auth', 'verified']);

// lecture result
Route::get('unit1/lektion{lecture}/result{session}', [LectureController::class, 'results'])->middleware(['auth', 'verified'])->name('results');

Route::post('/question_results', [QuestionResultsController::class, 'store'])->middleware(['auth', 'verified'])->name('results');
Route::get('/question_results', [QuestionResultsController::class, 'checkExistence'])->middleware(['auth', 'verified']);
Route::put('/question_results', [QuestionResultsController::class, 'updateCounter'])->middleware(['auth', 'verified']);

// fallback route with error 404
Route::fallback(function () {
    return Inertia::render('NotFound');
});
require __DIR__.'/auth.php';
