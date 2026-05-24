<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EducationalChannel;
use Illuminate\Http\Request;

class EducationalChannelController extends Controller
{
    public function index(Request $request)
{
    $departments = Department::where('status', 'active')
        ->orderBy('name')
        ->get();

    $query = EducationalChannel::with('department');

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

    $channels = $query->get();

    return view('admin.educational-channels.index', compact('channels', 'departments'));
}
    public function create()
    {
        $departments = Department::where('status', 'active')->get();

        return view('admin.educational-channels.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'channel_url' => 'required|url|max:255',
            'platform' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        EducationalChannel::create([
            'title' => $request->title,
            'department_id' => $request->department_id,
            'channel_url' => $request->channel_url,
            'platform' => $request->platform,
            'description' => $request->description,
            'status' => 'published',
        ]);

        return redirect()
            ->route('admin.educational-channels.index')
            ->with('success', 'تمت إضافة القناة التعليمية بنجاح');
    }

    public function destroy($id)
    {
        EducationalChannel::findOrFail($id)->delete();

        return back()->with('success', 'تم حذف القناة التعليمية بنجاح');
    }
}