<?php

use App\Models\Borrow;
use App\Models\LibraryBook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('home');
    }

    return view('home_guest');
})->name('home');

Route::get('/guest-blocked', function () {
    return redirect('/')->with('auth_required', 'يجب تسجيل الدخول أو إنشاء حساب أولاً');
})->name('guest.blocked');


/*
|--------------------------------------------------------------------------
| Routes for authenticated users
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Student / normal user routes
    |--------------------------------------------------------------------------
    */
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            $totalBooks = LibraryBook::count();
            $availableCopies = LibraryBook::where('status', 'available')->count();
            $pendingBorrows = Borrow::where('status', 'pending')->count();
            $totalStudents = User::where('role', 'student')->count();

            $latestBorrows = Borrow::with(['user', 'libraryBook'])
                ->latest()
                ->take(5)
                ->get();

            $latestBooks = LibraryBook::latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalBooks',
                'availableCopies',
                'pendingBorrows',
                'totalStudents',
                'latestBorrows',
                'latestBooks'
            ));
        })->name('dashboard');

        Route::get('/departments', function () {
            return view('admin.departments.index');
        })->name('departments.index');

        Route::get('/books', function () {
            return view('admin.books.index');
        })->name('books.index');

        Route::get('/digital-books', function () {
            return view('admin.digital-books.index');
        })->name('digital-books.index');

        Route::get('/borrows', function () {
            return view('admin.borrows.index');
        })->name('borrows.index');

        Route::get('/syllabuses', function () {
            return view('admin.syllabuses.index');
        })->name('syllabuses.index');

        Route::get('/past-exams', function () {
            return view('admin.past-exams.index');
        })->name('past-exams.index');

        Route::get('/projects', function () {
            return view('admin.projects.index');
        })->name('projects.index');

        Route::get('/students', function () {
            return view('admin.students.index');
        })->name('students.index');

        Route::get('/admins', function () {
            return view('admin.admins.index');
        })->name('admins.index');

        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('settings.index');
    });

require __DIR__.'/auth.php';