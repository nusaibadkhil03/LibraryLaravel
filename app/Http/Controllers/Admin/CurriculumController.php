<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    public function index()
    {
        $schedules = Curriculum::with('department')
            ->where('type', 'schedule')
            ->latest()
            ->get();

        $plans = Curriculum::with('department')
            ->where('type', 'plan')
            ->latest()
            ->get();

        $calendars = Curriculum::where('type', 'calendar')
            ->latest()
            ->get();

        $examSchedules = Curriculum::where('type', 'exam')->latest()->get();

        $departments = Department::where('status', 'active')->get();

        return view('admin.curriculum.index', compact(
    'schedules',
    'plans',
    'calendars',
    'examSchedules',
    'departments'
));
    }

    public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:schedule,plan,calendar,exam',
        'department_id' => 'nullable|exists:departments,id',
        'image' => 'required|image',
    ]);

    if (!in_array($request->type, ['calendar']) && !$request->department_id) {
        return back()->with('error', 'يجب اختيار القسم');
    }

    $query = Curriculum::where('type', $request->type);

    if (!in_array($request->type, ['calendar'])) {
        $query->where('department_id', $request->department_id);
    }

    $count = $query->count();

    if ($count >= 10) {
        return back()->with('error', 'وصلت للحد الأقصى (10 صور)');
    }

    $path = $request->file('image')->store('curriculum', 'public');

    Curriculum::create([
        'type' => $request->type,
        'department_id' => in_array($request->type, ['calendar'])
            ? null
            : $request->department_id,
        'image' => $path,
    ]);

    return back()->with('success', 'تم رفع الصورة بنجاح');
}

    public function destroy($id)
    {
        $item = Curriculum::findOrFail($id);

        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}