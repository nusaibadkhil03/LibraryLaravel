<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('status', 'active')->orderBy('name')->get();

        $query = User::with('department')
            ->where('role', 'student');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('student_number', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->get();

        return view('admin.students.index', compact('students', 'departments'));
    }

    public function updateStatus($id, $status)
    {
        $student = User::where('role', 'student')->findOrFail($id);

        if (! in_array($status, ['active', 'suspended'])) {
            abort(404);
        }

        $student->update([
            'status' => $status,
        ]);

        return back()->with('success', 'تم تحديث حالة الطالب بنجاح');
    }

    public function destroy($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return back()->with('success', 'تم حذف الطالب بنجاح');
    }
}