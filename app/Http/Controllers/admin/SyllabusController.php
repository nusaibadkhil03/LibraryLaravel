<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syllabus;
use App\Models\Department;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function index(Request $request)
{
    $departments = Department::where('status', 'active')
        ->orderBy('name')
        ->get();

    $query = Syllabus::with('department');

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

    $syllabuses = $query->get();

    return view('admin.syllabuses.index', compact('syllabuses', 'departments'));
}

    public function create()
    {
        $departments = Department::where('status', 'active')->get();
        return view('admin.syllabuses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'department_id' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx',
            'semester' => 'nullable|in:fall,spring,summer',
        ]);

        $filePath = $request->file('file')->store('syllabuses', 'public');

        Syllabus::create([
            'title' => $request->title,
            'department_id' => $request->department_id,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => 'published',
        ]);

        return redirect()->route('admin.syllabuses.index');
    }

    public function destroy($id)
    {
        Syllabus::destroy($id);
        return back();
    }
}