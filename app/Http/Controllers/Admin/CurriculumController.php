<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $schedules = Curriculum::where('type', 'schedule')->get();
        $plans = Curriculum::where('type', 'plan')->get();
        $calendars = Curriculum::where('type', 'calendar')->get();

        return view('admin.curriculum.index', compact('schedules', 'plans', 'calendars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'image' => 'required|image'
        ]);

        // حد أقصى 10 صور لكل نوع
        $count = Curriculum::where('type', $request->type)->count();

        if ($count >= 10) {
            return back()->with('error', 'وصلت للحد الأقصى (10 صور)');
        }

        $path = $request->file('image')->store('curriculum', 'public');

        Curriculum::create([
            'type' => $request->type,
            'image' => $path
        ]);

        return back()->with('success', 'تم رفع الصورة');
    }

    public function destroy($id)
    {
        $item = Curriculum::findOrFail($id);

        \Storage::disk('public')->delete($item->image);

        $item->delete();

        return back()->with('success', 'تم الحذف');
    }
}