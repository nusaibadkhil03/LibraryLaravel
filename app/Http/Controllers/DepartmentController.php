<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function show($slug)
    {
        $department = Department::where('slug', $slug)->firstOrFail();

        // الكتب الرقمية
        $books = $department->books;

        return view('departments.show', compact('department', 'books'));
    }
}