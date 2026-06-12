<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivity;
use App\Models\Category;
use App\Models\Department;
use App\Models\LibraryBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBookController extends Controller
{
    public function index(Request $request)
{
    $departments = Department::where('status', 'active')
        ->orderBy('name')
        ->get();

    $query = LibraryBook::with(['department', 'category']);

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('author', 'like', '%' . $request->search . '%')
              ->orWhere('publisher', 'like', '%' . $request->search . '%')
              ->orWhere('book_number', 'like', '%' . $request->search . '%')
              ->orWhere('category_name', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('department_id')) {
        $query->where('department_id', $request->department_id);
    }

    if ($request->filled('category_name')) {
        $query->where('category_name', 'like', '%' . $request->category_name . '%');
    }

    if ($request->filled('publication_year')) {
        $query->where('publication_year', $request->publication_year);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->sort === 'oldest') {
        $query->oldest();
    } elseif ($request->sort === 'title') {
        $query->orderBy('title');
    } elseif ($request->sort === 'copies_desc') {
        $query->orderByDesc('total_copies');
    } elseif ($request->sort === 'available_desc') {
        $query->orderByDesc('available_copies');
    } elseif ($request->sort === 'year_desc') {
        $query->orderByDesc('publication_year');
    } else {
        $query->latest();
    }

    $books = $query->get();

    return view('admin.books.index', compact(
        'books',
        'departments'
    ));
}

    public function create()
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('admin.books.create', compact(
            'departments',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $book = LibraryBook::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'publication_place' => $request->publication_place,
            'book_number' => $request->book_number,
            'edition_number' => $request->edition_number,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'category_name' => $request->category_name,
            'shelf_location' => $request->shelf_location,
            'total_copies' => $request->total_copies,
            'available_copies' => $request->total_copies,
            'status' => 'available',
            'department_name' => $request->department_name,
            'description' => $request->description,
        ]);

        AdminActivity::create([
            'admin_id' => Auth::id(),
            'action' => 'إضافة كتاب ورقي',
            'description' => 'تمت إضافة الكتاب الورقي: ' . $book->title,
            'type' => 'library_book',
        ]);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'تم إضافة الكتاب بنجاح');
    }

    public function destroy($id)
    {
        $book = LibraryBook::findOrFail($id);

        $title = $book->title;

        $book->delete();

        AdminActivity::create([
            'admin_id' => Auth::id(),
            'action' => 'حذف كتاب ورقي',
            'description' => 'تم حذف الكتاب الورقي: ' . $title,
            'type' => 'library_book',
        ]);

        return back()->with('success', 'تم حذف الكتاب بنجاح');
    }
}