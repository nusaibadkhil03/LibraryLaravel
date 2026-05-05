<?php

use App\Models\Borrow;
use App\Models\Book;
use App\Models\LibraryBook;
use App\Models\User;
use App\Models\Department;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PastExamController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\EducationalChannelController;

Route::get('/curriculum', function () {
    $schedules = Curriculum::where('type', 'schedule')->get();
    $plans = Curriculum::where('type', 'plan')->get();
    $calendars = Curriculum::where('type', 'calendar')->get();

    return view('curriculum.index', compact('schedules', 'plans', 'calendars'));
})->name('curriculum');
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Admin\SyllabusController;
use App\Http\Controllers\DepartmentContentController;


Route::get('/', function () {
    $departments = Department::where('status', 'active')->latest()->get();

    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('home', compact('departments'));
    }

    return view('home_guest', compact('departments'));
})->name('home');

Route::get('/guest-blocked', function () {
    return redirect('/')->with('auth_required', 'يجب تسجيل الدخول أو إنشاء حساب أولاً');
})->name('guest.blocked');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    // صفحة الاستعارة للطالب
    Route::get('/borrow', function () {
        $books = LibraryBook::all();

        $borrows = Borrow::with('libraryBook')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('borrow', compact('books', 'borrows'));
    })->name('borrow');

    // إرسال طلب الاستعارة
    Route::post('/borrow', function (Request $request) {
        Borrow::create([
            'user_id' => auth()->id(),
            'library_book_id' => $request->book_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم إرسال طلب الاستعارة بنجاح');
    })->name('borrow.store');


    Route::view('/curriculum', 'curriculum')->name('curriculum');
    Route::view('/projects', 'projects')->name('projects');
    Route::view('/exams', 'exams')->name('exams');


    Route::get('/departments/{slug}', [DepartmentController::class, 'show'])
    ->name('departments.show');
    Route::get('/departments/{department}/content/{type}', [DepartmentContentController::class, 'show'])
    ->name('departments.content');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            $borrowRequestsCount = Borrow::where('status', 'pending')->count();
            $studentsCount = User::where('role', 'student')->count();
            $booksCount = LibraryBook::count();
            $departmentsCount = Department::count();

         


            $latestBorrows = Borrow::with(['user', 'libraryBook'])
                ->latest()
                ->take(5)
                ->get();

            $latestBooks = LibraryBook::with('department')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'borrowRequestsCount',
                'studentsCount',
                'booksCount',
                'departmentsCount',
                'latestBorrows',
                'latestBooks'
            ));
            
        })->name('dashboard');
        Route::resource('syllabuses', SyllabusController::class); 
        Route::resource('past-exams', PastExamController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('researches', ResearchController::class);
        Route::resource('educational-channels', EducationalChannelController::class);
        
        Route::resource('curriculum', App\Http\Controllers\Admin\CurriculumController::class);

        Route::get('/departments', function () {
            $departments = Department::latest()->get();
            return view('admin.departments.index', compact('departments'));
        })->name('departments.index');

        Route::post('/departments', function (Request $request) {
            Department::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'status' => 'active',
            ]);

            return back()->with('success', 'تمت إضافة القسم بنجاح');
        })->name('departments.store');

        Route::delete('/departments/{id}', function ($id) {
            Department::findOrFail($id)->delete();
            return back()->with('success', 'تمت العملية بنجاح');
        })->name('departments.delete');

        Route::get('/borrows', function () {
            $borrows = Borrow::with(['user', 'libraryBook'])
                ->latest()
                ->get();

            return view('admin.borrows.index', compact('borrows'));
        })->name('borrows.index');
        Route::post('/borrows/{id}/approve', function ($id) {
    $borrow = \App\Models\Borrow::findOrFail($id);
    $borrow->update(['status' => 'approved']);

    return back()->with('success', 'تم قبول طلب الاستعارة');
})->name('borrows.approve');


Route::post('/borrows/{id}/reject', function ($id) {
    $borrow = \App\Models\Borrow::findOrFail($id);
    $borrow->update(['status' => 'rejected']);

    return back()->with('success', 'تم رفض طلب الاستعارة');
})->name('borrows.reject');


        Route::get('/books', function () {
    $books = LibraryBook::with('department')->latest()->get();
    $departments = Department::where('status', 'active')->get();

    return view('admin.books.index', compact('books', 'departments'));
  })->name('books.index');

  Route::post('/books', function (Request $request) { 
    LibraryBook::create([
        'title' => $request->title,
        'author' => $request->author,
        'publisher' => $request->publisher,
        'publication_year' => $request->publication_year,
        'publication_place' => $request->publication_place,
        'book_number' => $request->book_number,
        'department_id' => $request->department_id,
        'shelf_location' => $request->shelf_location,
        'total_copies' => $request->total_copies,
        'available_copies' => $request->total_copies,
        'status' => 'available',
    ]);

    return back()->with('success', 'تم إضافة الكتاب بنجاح');
     })->name('books.store');
        Route::get('/digital-books', function () {
    $books = Book::with('department')->latest()->get();
    $departments = Department::where('status', 'active')->get();

    return view('admin.digital-books.index', compact('books', 'departments'));
})->name('digital-books.index');

Route::post('/digital-books', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id',
        'semester' => 'nullable|string|max:255',
        'author' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'file' => 'required|mimes:pdf|max:20480',
    ]);

    $filePath = $request->file('file')->store('books', 'public');

    Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'department_id' => $request->department_id,
        'semester' => $request->semester,
        'description' => $request->description,
        'file_path' => $filePath,
        'status' => 'published',
    ]);

    return back()->with('success', 'تم رفع الكتاب الرقمي بنجاح');
})->name('digital-books.store');
       
      /* 
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
        })->name('settings.index');*/
    });
require __DIR__.'/auth.php';