<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/signup', 'signup')->name('signup');

Route::view('/borrow', 'borrow')->name('borrow');
Route::view('/curriculum', 'curriculum')->name('curriculum');
Route::view('/projects', 'projects')->name('projects');
Route::view('/exams', 'exams')->name('exams');

Route::get('/departments/{slug}', function ($slug) {
    $departments = [
        'computer-science' => [
            'name' => 'الحاسب الآلي',
            'icon' => '💻',
        ],
        'business-administration' => [
            'name' => 'إدارة الأعمال',
            'icon' => '📈',
        ],
        'accounting' => [
            'name' => 'المحاسبة',
            'icon' => '💰',
        ],
        'law' => [
            'name' => 'القانون',
            'icon' => '⚖️',
        ],
        'architecture' => [
            'name' => 'هندسة العمارة',
            'icon' => '🏛️',
        ],
        'petroleum-engineering' => [
            'name' => 'هندسة النفط',
            'icon' => '🛢️',
        ],
    ];

    abort_unless(isset($departments[$slug]), 404);

    return view('departments.show', [
        'data' => $departments[$slug],
    ]);
})->name('departments.show');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__.'/auth.php';