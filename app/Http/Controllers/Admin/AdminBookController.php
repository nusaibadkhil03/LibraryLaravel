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
    public function index()
    {
        $books = LibraryBook::with(['department', 'category'])
            ->orderBy('title')
            ->get();

        return view('admin.books.index', compact('books'));
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