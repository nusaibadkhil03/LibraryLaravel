<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Book;
use App\Models\Syllabus;
use App\Models\PastExam;
use App\Models\Project;
use App\Models\Research;
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
        if ($type === 'past-exams') {
          $items = PastExam::where('department_id', $department->id)
          ->where('status', 'published')
          ->latest()
          ->get();
          if ($type === 'projects') {

    $items = Project::where('department_id', $department->id)
        ->where('status', 'published')
        ->latest()
        ->get();

    return view('departments.partials.file-list', [
        'items' => $items,
        'title' => 'مشاريع التخرج',
        'emptyMessage' => 'لا توجد مشاريع مضافة لهذا القسم حالياً.',
    ]);
}

    return view('departments.partials.file-list', [
        'items' => $items,
        'title' => 'أسئلة سنوات سابقة',
        'emptyMessage' => 'لا توجد أسئلة سنوات مضافة لهذا القسم حالياً.',
    ]);
  }
    if ($type === 'projects') {
    $items = Project::where('department_id', $department->id)
        ->where('status', 'published')
        ->latest()
        ->get();

    return view('departments.partials.file-list', [
        'items' => $items,
        'title' => 'مشاريع التخرج',
        'emptyMessage' => 'لا توجد مشاريع تخرج مضافة لهذا القسم حالياً.',
    ]);
}
if ($type === 'researches') {
    $items = Research::where('department_id', $department->id)
        ->where('status', 'published')
        ->latest()
        ->get();

    return view('departments.partials.file-list', [
        'items' => $items,
        'title' => 'البحوث العلمية',
        'emptyMessage' => 'لا توجد بحوث علمية حالياً.',
    ]);
}
        return response('المحتوى غير موجود', 404);
    }
}