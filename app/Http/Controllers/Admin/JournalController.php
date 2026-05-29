<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index(Request $request)
{
    $query = Journal::query();

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->sort === 'oldest') {
        $query->oldest();
    } elseif ($request->sort === 'title') {
        $query->orderBy('title');
    } else {
        $query->latest();
    }

    $journals = $query->get();

    return view('admin.journals.index', compact('journals'));
}

    public function create()
    {
        return view('admin.journals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issue_number' => 'nullable|string|max:255',
            'publication_year' => 'required|digits:4',
            'publication_date' => 'nullable|date',
            'publisher' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:pdf|max:20480',
        ]);

        $filePath = $request->file('file')->store('journals', 'public');

        $journal = Journal::create([
            'title' => $request->title,
            'issue_number' => $request->issue_number,
            'publication_year' => $request->publication_year,
            'publication_date' => $request->publication_date,
            'publisher' => $request->publisher,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);
        AdminActivity::create([
    'admin_id' => Auth::id(),
    'action' => 'إضافة مجلة',
    'description' => 'تمت إضافة المجلة: ' . $journal->title,
    'type' => 'journal',
]);

        return redirect()
            ->route('admin.journals.index')
            ->with('success', 'تمت إضافة المجلة بنجاح');
    }

    public function destroy($id)
{
    $journal = Journal::findOrFail($id);

    $title = $journal->title;

    if ($journal->file_path) {
        Storage::disk('public')->delete($journal->file_path);
    }

    $journal->delete();

    AdminActivity::create([
        'admin_id' => Auth::id(),
        'action' => 'حذف مجلة',
        'description' => 'تم حذف المجلة: ' . $title,
        'type' => 'journal',
    ]);

    return back()->with('success', 'تم حذف المجلة بنجاح');
}
}