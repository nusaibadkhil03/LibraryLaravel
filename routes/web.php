<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/borrow', 'borrow');
Route::view('/books', 'books');
Route::view('/curriculum', 'curriculum');
Route::view('/projects', 'projects');
Route::view('/exams', 'exams');

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::view('/signup', 'signup');

Route::view('/', 'home');
Route::view('/borrow', 'borrow');
Route::view('/books', 'books');
Route::view('/curriculum', 'curriculum')->name('curriculum');
Route::view('/projects', 'projects');
Route::view('/exams', 'exams');