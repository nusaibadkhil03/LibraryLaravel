<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Book;
use App\Models\Syllabus;
use Illuminate\Http\Request;

class DepartmentContentController extends Controller
{
    public function show(Department $department, $type)
    {
        if ($type === 'books') {
            $items = Book::where('department_id', $department->id)
                ->latest()
                ->get();

            return view('departments.partials.file-list', [
                'items' => $items,
                'title' => 'الكتب الرقمية',
                'type' => 'books',
            ]);
        }

        if ($type === 'syllabuses') {
            $items = Syllabus::where('department_id', $department->id)
                ->where('status', 'published')
                ->latest()
                ->get();

            return view('departments.partials.file-list', [
                'items' => $items,
                'title' => 'المناهج',
                'type' => 'syllabuses',
            ]);
        }

        return response('المحتوى غير موجود', 404);
    }
}