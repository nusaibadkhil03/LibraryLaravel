<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Http\Request;

class CurriculumPageController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('status', 'active')->get();

        $selectedDepartment = $request->department_id;

        $schedules = collect();
        $plans = collect();

        if ($selectedDepartment) {
            $schedules = Curriculum::where('type', 'schedule')
                ->where('department_id', $selectedDepartment)
                ->latest()
                ->get();

            $plans = Curriculum::where('type', 'plan')
                ->where('department_id', $selectedDepartment)
                ->latest()
                ->get();
        }

        $calendars = Curriculum::where('type', 'calendar')
            ->latest()
            ->get();

        return view('curriculum.index', compact(
            'departments',
            'selectedDepartment',
            'schedules',
            'plans',
            'calendars'
        ));
    }
}