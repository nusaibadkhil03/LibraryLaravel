<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use App\Models\Department;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    public function index(Request $request)
{
    $departments = Department::where('status', 'active')
        ->orderBy('name')
        ->get();

    $query = Research::with('department');
    
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

    $researches = $query->get();

    return view('admin.researches.index', compact('researches', 'departments'));
}

    public function create()
    {
        $departments = Department::where('status', 'active')->get();
        return view('admin.researches.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf|max:20480',
        ]);

        $filePath = $request->file('file')->store('researches', 'public');

        $research = Research::create([
    'title' => $request->title,
    'department_id' => $request->department_id,
    'author' => $request->author,
    'publisher' => $request->publisher,
    'publication_year' => $request->publication_year,
    'description' => $request->description,
    'file_path' => $filePath,
    'status' => 'published',
]);

AdminActivity::create([
    'admin_id' => Auth::id(),
    'action' => 'إضافة بحث',
    'description' => 'تمت إضافة البحث: ' . $research->title,
    'type' => 'research',
]);

        return redirect()->route('admin.researches.index')
            ->with('success', 'تمت إضافة البحث بنجاح');
    }

    public function destroy($id)
{
    $research = Research::findOrFail($id);

    $title = $research->title;

    if (
        $research->file_path &&
        Storage::disk('public')->exists($research->file_path)
    ) {
        Storage::disk('public')->delete($research->file_path);
    }

    $research->delete();

    AdminActivity::create([
        'admin_id' => Auth::id(),
        'action' => 'حذف بحث',
        'description' => 'تم حذف البحث: ' . $title,
        'type' => 'research',
    ]);

    return back()->with('success', 'تم حذف البحث بنجاح');
}
}