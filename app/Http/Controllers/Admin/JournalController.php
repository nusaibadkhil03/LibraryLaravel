<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::latest()->get();
        return view('admin.journals.index', compact('journals'));
    }

    public function create()
    {
        return view('admin.journals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'publication_year' => 'required',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'file' => 'required|mimes:pdf'
        ]);

        $filePath = $request->file('file')->store('journals', 'public');

        Journal::create([
            'title' => $request->title,
            'publication_year' => $request->publication_year,
            'publisher' => $request->publisher,
            'description' => $request->description,
            'file_path' => $filePath
        ]);

        return redirect()
            ->route('admin.journals.index')
            ->with('success', 'تمت إضافة المجلة');
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);

        Storage::disk('public')->delete($journal->file_path);

        $journal->delete();

        return back()->with('success', 'تم حذف المجلة');
    }
}