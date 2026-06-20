<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Department;
use App\Models\AdminActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DigitalBookController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        $query = Book::with('department');

        if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->sort === 'oldest') {
            $query->oldest();
        } elseif ($request->sort === 'title') {
            $query->orderBy('title');
        } else {
            $query->latest();
        }

        $books = $query->get();

        return view('admin.digital-books.index', compact('books', 'departments'));
    }

    public function create()
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.digital-books.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'semester' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:pdf|max:102400',
        ]);

        $filePath = $request->file('file')->store('books', 'public');

        $book = Book::create([
    'title' => $request->title,
    'author' => $request->author,
    'department_id' => $request->department_id,
    'semester' => $request->semester,
    'description' => $request->description,
    'file_path' => $filePath,
    'status' => 'published',
]);

AdminActivity::create([
    'admin_id' => Auth::id(),
    'action' => 'إضافة كتاب رقمي',
    'description' => 'تمت إضافة الكتاب الرقمي: ' . $book->title,
    'type' => 'digital_book',
]);

        return back()->with('success', 'تم رفع الكتاب الرقمي بنجاح');
    }

    public function download($id)
{
    $book = Book::findOrFail($id);

    if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
        abort(404);
    }

    $book->increment('downloads_count');

    return response()->download(
        storage_path('app/public/' . $book->file_path),
        basename($book->file_path)
    );
}

   public function destroy($id)
{
    $book = Book::findOrFail($id);

    $title = $book->title;

    if (
        $book->file_path &&
        Storage::disk('public')->exists($book->file_path)
    ) {
        Storage::disk('public')->delete($book->file_path);
    }

    $book->delete();

    AdminActivity::create([
        'admin_id' => Auth::id(),
        'action' => 'حذف كتاب رقمي',
        'description' => 'تم حذف الكتاب الرقمي: ' . $title,
        'type' => 'digital_book',
    ]);

    return back()->with('success', 'تم حذف الكتاب الرقمي بنجاح');
}
}