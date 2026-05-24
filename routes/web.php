<?php

use App\Models\Borrow;
use App\Models\Book;
use App\Models\LibraryBook;
use App\Models\User;
use App\Models\Department;
use App\Models\Curriculum;
use App\Models\Project;
use App\Models\PastExam;
use App\Models\Research;
use App\Models\Journal;
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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Admin\AdminBorrowController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\CurriculumPageController;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Admin\SyllabusController;
use App\Http\Controllers\DepartmentContentController;
use App\Http\Controllers\Admin\DigitalBookController;



Route::get('/plain', function () {
    return '<h1>Plain HTML works</h1>';
});

Route::get('/blade', function () {
    return view('test');
});


Route::get('/curriculum', [CurriculumPageController::class, 'index'])
    ->name('curriculum');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/live-search', [SearchController::class, 'live'])->name('live.search');

Route::get('/borrow', function () {
    $books = LibraryBook::all();

    $borrows = Borrow::with('libraryBook')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('borrow', compact('books', 'borrows'));
})->name('borrow');

Route::post('/borrows/{book}', [BorrowController::class, 'store'])
    ->name('borrows.store');

 
Route::get('/', function () {
    $departments = Department::latest()->get();

    $stats = [
        'departments' => Department::count(),
        'books' => Book::count(),
        'projects' => Project::count(),
        'exams' => PastExam::count(),
        'researches' => Research::count(),
        'borrows' => Borrow::count(),
    ];

    $latestBooks = Book::latest()->take(4)->get();
    $latestProjects = Project::latest()->take(3)->get();
    $latestResearches = Research::latest()->take(3)->get();

    $mostDownloadedBooks = collect();

    // بدل Research لازم Journal
    $latestJournals = Journal::latest()
        ->take(3)
        ->get();

    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('home', compact(
            'departments',
            'stats',
            'latestBooks',
            'latestProjects',
            'latestResearches',
            'mostDownloadedBooks',
            'latestJournals'
        ));
    }

    return view('home_guest', compact(
        'departments',
        'stats',
        'latestBooks',
        'latestProjects',
        'latestResearches',
        'mostDownloadedBooks',
        'latestJournals'
    ));
})->name('home');



Route::get('/journals', function () {
    $journals = Journal::latest()->paginate(9);

    return view('journals.index', compact('journals'));
})->name('journals');

Route::get('/about', function () {
    $departments = Department::where('status', 'active')->get();

    return view('about', compact('departments'));
})->name('about');

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
Route::post('/borrow', function (Request $request) {

    $request->validate([
        'book_id' => 'required|exists:library_books,id',
    ]);

    $book = LibraryBook::findOrFail($request->book_id);

    if ($book->available_copies <= 1) {
        return back()->with('error', 'لا يمكن استعارة هذا الكتاب لأنه متوفر بنسخة واحدة فقط.');
    }

    Borrow::create([
    'user_id' => auth()->id(),
    'library_book_id' => $book->id,
    'student_name' => $request->student_name,
    'student_number' => $request->student_number,
    'edition_number' => $request->edition_number,
    'status' => 'pending',
    'notes' => 'تنبيه: في حالة التأخر عن تاريخ الإرجاع سيتم تطبيق غرامة مالية.',
]);

    return back()->with('success', 'تم إرسال طلب الاستعارة بنجاح');
})->name('borrow.store');

    Route::view('/projects', 'projects')->name('projects');
    Route::view('/exams', 'exams')->name('exams');


    Route::get('/departments/{slug}', [DepartmentController::class, 'show'])
    ->name('departments.show');
    Route::get('/departments/{department}/content/{type}', [DepartmentContentController::class, 'show'])
    ->name('departments.content');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



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
        
        Route::get('/curriculum', [CurriculumController::class, 'index'])
    ->name('curriculum.index');

    Route::post('/curriculum/store', [CurriculumController::class, 'store'])
    ->name('curriculum.store');

Route::delete('/curriculum/{id}', [CurriculumController::class, 'destroy'])
    ->name('curriculum.destroy');

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

    $borrow = \App\Models\Borrow::with('libraryBook')->findOrFail($id);

    $book = $borrow->libraryBook;

    if ($book->available_copies <= 1) {
        return back()->with('error', 'لا يمكن قبول الطلب لأن المتبقي نسخة واحدة فقط.');
    }

    $borrow->update([
        'status' => 'borrowed',
        'borrow_date' => now()->toDateString(),
        'due_date' => now()->addDays(14)->toDateString(),
        'approved_by' => auth()->id(),
    ]);

    $book->decrement('available_copies');

    return back()->with('success', 'تم قبول طلب الاستعارة');

})->name('borrows.approve');


Route::post('/borrows/{id}/reject', function ($id) {
    $borrow = \App\Models\Borrow::findOrFail($id);
    $borrow->update(['status' => 'rejected']);

    return back()->with('success', 'تم رفض طلب الاستعارة');
})->name('borrows.reject');

Route::post('/borrows/{id}/return', function ($id) {

    $borrow = \App\Models\Borrow::with('libraryBook')->findOrFail($id);

    if ($borrow->status != 'borrowed') {
        return back()->with('error', 'لا يمكن إرجاع هذا الكتاب.');
    }

    $borrow->update([
        'status' => 'returned',
        'return_date' => now()->toDateString(),
    ]);

    $borrow->libraryBook->increment('available_copies');

    return back()->with('success', 'تم إرجاع الكتاب بنجاح');

})->name('borrows.return');


       Route::get('/books', function () {

    $books = LibraryBook::with('department')
    ->orderBy('title')
    ->get();

    return view('admin.books.index', compact('books'));

})->name('books.index');



Route::get('/books/create', function () {

$departments = Department::where('status', 'active')
    ->orderBy('name')
    ->get();
    return view('admin.books.create', compact('departments'));

})->name('books.create');



Route::post('/books', function (Request $request) {

    LibraryBook::create([

        'title' => $request->title,

        'author' => $request->author,

        'publisher' => $request->publisher,

        'publication_year' => $request->publication_year,

        'publication_place' => $request->publication_place,

        'book_number' => $request->book_number,

        'edition_number' => $request->edition_number,

        'department_id' => $request->department_id,

        'shelf_location' => $request->shelf_location,

        'total_copies' => $request->total_copies,

        'available_copies' => $request->total_copies,

        'status' => 'available',

    ]);

    return back()->with('success', 'تم إضافة الكتاب بنجاح');

})->name('books.store');

    

Route::get('/journals', [JournalController::class,'index'])
        ->name('journals.index');

        Route::get('/journals/create', [JournalController::class,'create'])
        ->name('journals.create');

    Route::post('/journals/store', [JournalController::class,'store'])
        ->name('journals.store');

    Route::delete('/journals/{id}', [JournalController::class,'destroy'])
        ->name('journals.destroy');

Route::get('/digital-books', [DigitalBookController::class, 'index'])
    ->name('digital-books.index');

Route::get('/digital-books/create', [DigitalBookController::class, 'create'])
    ->name('digital-books.create');

Route::post('/digital-books', [DigitalBookController::class, 'store'])
    ->name('digital-books.store');

Route::delete('/digital-books/{id}', [DigitalBookController::class, 'destroy'])
    ->name('digital-books.destroy');
    });
});
require __DIR__.'/auth.php';