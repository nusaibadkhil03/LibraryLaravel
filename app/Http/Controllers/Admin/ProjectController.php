<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('department')->latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $departments = Department::where('status', 'active')->get();

        return view('admin.projects.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'students_names' => 'nullable|string|max:255',
            'supervisor_name' => 'nullable|string|max:255',
            'academic_year' => 'nullable|string|max:50',
            'semester' => 'nullable|in:fall,spring,summer',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:20480',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;
        $coverPath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('projects', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('projects/covers', 'public');
        }

        Project::create([
            'title' => $request->title,
            'department_id' => $request->department_id,
            'students_names' => $request->students_names,
            'supervisor_name' => $request->supervisor_name,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'description' => $request->description,
            'file_path' => $filePath,
            'cover_image' => $coverPath,
            'status' => 'published',
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'تمت إضافة مشروع التخرج بنجاح');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->file_path && Storage::disk('public')->exists($project->file_path)) {
            Storage::disk('public')->delete($project->file_path);
        }

        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return back()->with('success', 'تم حذف مشروع التخرج بنجاح');
    }
}