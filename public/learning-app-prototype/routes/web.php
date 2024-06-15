<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LectureOverviewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionResultsController;
use App\Http\Controllers\UnitController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Spielübersicht
Route::get('unit{unit}/lektionen',[LectureOverviewController::class, 'index'])->middleware(['auth', 'verified']);

//Unitübersicht
Route::get('units',[UnitController::class, 'index'])->middleware(['auth', 'verified']);

//Spielseite der einzelnen Lektionen
Route::get('unit1/lektion{lecture}',[LectureController::class, 'index'])->middleware(['auth', 'verified'])->name('spiel.lektion');

//Ergebnisse nach Lektion 
Route::get('unit1/lektion{lecture}/result/{session}', [LectureController::class, 'results'])->middleware(['auth', 'verified'])->name('results');

Route::post('/question_results', [QuestionResultsController::class, 'store'])->middleware(['auth', 'verified'])->name('results');
Route::get('/question_results', [QuestionResultsController::class, 'checkExistence'])->middleware(['auth', 'verified']);
Route::put('/question_results', [QuestionResultsController::class, 'updateCounter'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
