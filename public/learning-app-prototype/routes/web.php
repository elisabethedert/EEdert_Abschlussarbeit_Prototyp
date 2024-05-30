<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpielController;
use App\Http\Controllers\QuestionResultsController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Spielübersicht
Route::get('spiel',[SpielController::class, 'index']);

//Spielseite der einzelnen Lektionen
Route::get('spiel/lektion{lecture}',[LectureController::class, 'index']);

//Ergebnisse nach Lektion 
Route::post('/results', [LectureController::class, 'results'])->name('results');

Route::post('/question_results', [QuestionResultsController::class, 'store'])->name('results');
Route::get('/question_results', [QuestionResultsController::class, 'checkExistence']);
Route::put('/question_results', [QuestionResultsController::class, 'updateCounter']);

require __DIR__.'/auth.php';
