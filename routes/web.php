<?php

use App\Models\Borrow;
use App\Models\Book;
use App\Models\LibraryBook;
use App\Models\User;
use App\Models\Department;
use App\Models\Curriculum;
use App\Models\Project;
use App\Models\Syllabus;
use App\Models\PastExam;
use App\Models\Research;
use App\Models\Journal;
use App\Models\AdminActivity;
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
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\AdminBookController;






Route::get('/curriculum', [CurriculumPageController::class, 'index'])
    ->name('curriculum');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/live-search', [SearchController::class, 'live'])->name('live.search');

Route::middleware('auth')->group(function () {

    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])
        ->name('favorites.toggle');

});

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
    'library_books' => LibraryBook::count(),
    'projects' => Project::count(),
    'syllabuses' => Syllabus::count(),
    'departments' => Department::count(),
    'researches' => Research::count(),
];

    $latestBooks = Book::latest()->take(4)->get();

    $latestProjects = Project::latest()->take(3)->get();

    $latestResearches = Research::latest()->take(3)->get();

    $latestJournals = Journal::latest()
        ->take(3)
        ->get();

    $latestContents = collect()
        ->merge(Book::latest()->take(2)->get())
        ->merge(Syllabus::latest()->take(2)->get())
        ->merge(PastExam::latest()->take(2)->get())
        ->merge(Project::latest()->take(2)->get())
        ->sortByDesc('created_at')
        ->take(5);

$mostDownloadedBooks = Book::orderByDesc('downloads_count')
    ->take(5)
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
            'latestJournals',
            'latestContents',
            'mostDownloadedBooks'
        ));
    }

    return view('home_guest', compact(
        'departments',
        'stats',
        'latestBooks',
        'latestProjects',
        'latestResearches',
        'latestJournals',
        'latestContents',
        'mostDownloadedBooks'
    ));

    

})->name('home');

Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['ar', 'en'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

Route::get('/books/{book}/download', function (Book $book) {
    $book->increment('downloads_count');

    return response()->download(storage_path('app/public/' . $book->file_path));
})->name('books.download');

Route::get('/digital-books/{id}/download', [DigitalBookController::class, 'download'])
    ->name('digital-books.download');
   

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

Route::get('/borrow/books/search', function (Request $request) {

    $search = $request->q;

    if (!$search || mb_strlen($search) < 3) {
        return response()->json([]);
    }

    $books = LibraryBook::where('status', 'available')
        ->where('available_copies', '>', 1)
        ->where('title', 'like', '%' . $search . '%')
        ->orderBy('title')
        ->limit(10)
        ->get([
            'id',
            'title',
            'author',
            'edition_number'
        ]);

    return response()->json($books);

})->name('borrow.books.search');

    Route::view('/projects', 'projects')->name('projects');
    Route::view('/exams', 'exams')->name('exams');


    Route::get('/departments/{slug}', [DepartmentController::class, 'show'])
    ->name('departments.show');
    Route::get('/departments/{department}/content/{type}', [DepartmentContentController::class, 'show'])
    ->name('departments.content');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


/* --------admin routes-------- */
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {

    $pendingBorrowsCount = Borrow::where('status', 'pending')->count();

    $totalBorrowsCount = Borrow::count();

    $approvedBorrowsCount = Borrow::whereIn('status', ['approved', 'borrowed'])->count();

    $returnedBorrowsCount = Borrow::where('status', 'returned')->count();

    $studentsCount = User::where('role', 'student')->count();

    $booksCount = LibraryBook::count();

    $availableBooksCount = LibraryBook::sum('available_copies');

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
        'pendingBorrowsCount',
        'totalBorrowsCount',
        'approvedBorrowsCount',
        'returnedBorrowsCount',
        'studentsCount',
        'booksCount',
        'availableBooksCount',
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

         Route::get('/live-search', [SearchController::class, 'adminLive'])
    ->name('live-search');

    Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');

Route::patch('/students/{id}/status/{status}', [StudentController::class, 'updateStatus'])
    ->name('students.updateStatus');

Route::delete('/students/{id}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

   Route::get('/admins', [AdminUserController::class, 'index'])
    ->name('admins.index');

Route::patch('/admins/{id}/role/{role}', [AdminUserController::class, 'updateRole'])
    ->name('admins.updateRole');

    Route::get('/users/create',
    [AdminUserController::class,'create'])
    ->name('users.create');

Route::post('/users/store',
    [AdminUserController::class,'store'])
    ->name('users.store');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])
    ->name('users.destroy');
        
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

    $borrow = Borrow::with('libraryBook')->findOrFail($id);

    $book = $borrow->libraryBook;

    if ($book->available_copies <= 1) {
        return back()->with('error', 'لا يمكن قبول الطلب لأن المتبقي نسخة واحدة فقط.');
    }

    $borrow->update([
        'status' => 'borrowed',
        'borrow_date' => now()->toDateString(),
        'due_date' => now()->addDays(5)->toDateString(),
        'approved_by' => auth()->id(),
    ]);

    $book->decrement('available_copies');

    return back()->with('success', 'تم قبول طلب الاستعارة');

})->name('borrows.approve');

Route::post('/borrows/{id}/reject',
    [AdminBorrowController::class, 'reject']
)->name('borrows.reject');

Route::get('/borrows/{id}/return',
    [AdminBorrowController::class, 'returnForm']
)->name('borrows.returnForm');

Route::post('/borrows/{id}/return',
    [AdminBorrowController::class, 'returnBook']
)->name('borrows.return');


      Route::get('/books', [AdminBookController::class, 'index'])
    ->name('books.index');

Route::get('/books/create', [AdminBookController::class, 'create'])
    ->name('books.create');

Route::post('/books', [AdminBookController::class, 'store'])
    ->name('books.store');

Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])
    ->name('books.destroy');
    

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