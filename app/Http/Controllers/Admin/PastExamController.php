<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\PastExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PastExamController extends Controller
{
    public function index()
{
    $pastExams = PastExam::with('department')->latest()->get();

    return view('admin.past-exams.index', compact('pastExams'));
}

    public function create()
    {
        $departments = Department::where('status', 'active')->get();

        return view('admin.past-exams.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'subject_name' => 'nullable|string|max:255',
            'doctor_name' => 'nullable|string|max:255',
            'academic_year' => 'nullable|string|max:50',
            'semester' => 'nullable|in:fall,spring,summer',
            'exam_year' => 'nullable|digits:4',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:20480',
        ]);

        $filePath = $request->file('file')->store('past_exams', 'public');

        PastExam::create([
            'title' => $request->title,
            'department_id' => $request->department_id,
            'subject_name' => $request->subject_name,
            'doctor_name' => $request->doctor_name,
            'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'exam_year' => $request->exam_year,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => 'published',
        ]);

        return redirect()
            ->route('admin.past-exams.index')
            ->with('success', 'تمت إضافة أسئلة السنة بنجاح');
    }

    public function destroy($id)
    {
        $exam = PastExam::findOrFail($id);

        if ($exam->file_path && Storage::disk('public')->exists($exam->file_path)) {
            Storage::disk('public')->delete($exam->file_path);
        }

        $exam->delete();

        return back()->with('success', 'تم حذف أسئلة السنة بنجاح');
    }
}