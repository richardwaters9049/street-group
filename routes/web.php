<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\ParserController;
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

// Route for handling file uploads
// Matches POST requests to /upload 
// Calls upload method on App\Http\Controllers\HomeController
Route::post('/upload', 'App\Http\Controllers\HomeController@upload');

// Route for handling file uploads
// Matches POST requests to /upload-csv
// Calls uploadCsv method on App\Http\Controllers\CsvController
Route::post('/upload-csv', [CsvController::class, 'uploadCsv'])->name('upload.csv');

// Route::post('/parse-csv', [CsvController::class, 'parseCsv'])->name('parse-csv');

Route::get('/parse-csv/{filename}', [ParserController::class, 'parseCSVFile'])->name('parse.csv');



require __DIR__ . '/auth.php';
