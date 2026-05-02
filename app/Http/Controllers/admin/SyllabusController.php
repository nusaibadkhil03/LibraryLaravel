<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syllabus;
use App\Models\Department;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function index()
    {
        $syllabuses = Syllabus::with('department')->latest()->get();
        return view('admin.syllabuses.index', compact('syllabuses'));
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