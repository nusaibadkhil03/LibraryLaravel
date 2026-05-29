<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\LibraryBook;
use App\Models\PastExam;
use App\Models\Project;
use App\Models\Research;
use App\Models\Syllabus;
use App\Models\EducationalChannel;
use App\Models\Category;
use App\Models\Department;

class SearchController extends Controller
{ 
    public function index(Request $request)
    {
        $q = $request->input('q');

        $books = Book::where('title', 'like', "%{$q}%")->get();
        $libraryBooks = LibraryBook::where('title', 'like', "%{$q}%")->get();
        $pastExams = PastExam::where('title', 'like', "%{$q}%")->get();
        $projects = Project::where('title', 'like', "%{$q}%")->get();
        $researches = Research::where('title', 'like', "%{$q}%")->get();
        $syllabuses = Syllabus::where('title', 'like', "%{$q}%")->get();
        $channels = EducationalChannel::where('title', 'like', "%{$q}%")->get();

        $categories = Category::where('name', 'like', "%{$q}%")->get();
        $departments = Department::where('name', 'like', "%{$q}%")->get();

        return view('search.results', compact(
            'q',
            'books',
            'libraryBooks',
            'pastExams',
            'projects',
            'researches',
            'syllabuses',
            'channels',
            'categories',
            'departments'
        ));
    }
   public function live(Request $request)
{
    $q = $request->q;
    $results = [];

    // 📚 الكتب
    foreach (Book::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'كتاب',
             'url' => route('departments.show', $item->department->slug) . '?type=books'
        ];
    }

    // 🎓 المشاريع
    foreach (Project::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'مشروع',
            'url' => route('departments.show', $item->department->slug) . '?type=projects'
        ];
    }

    // 📝 أسئلة سابقة
    foreach (PastExam::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'امتحان',
            'url' => route('departments.show', $item->department->slug) . '?type=past-exams'

        ];
    }

    // 📖 المناهج
    foreach (Syllabus::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'منهج',
           'url' => route('departments.show', $item->department->slug) . '?type=syllabuses'

        ];
    }
    // 🔬 البحوث
foreach (Research::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
    $results[] = [
        'title' => $item->title,
        'type' => 'بحث',
        'url' => route('departments.show', $item->department->slug) . '?type=researches'
    ];
}

// 📺 القنوات التعليمية
foreach (EducationalChannel::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
    $results[] = [
        'title' => $item->title,
        'type' => 'قناة تعليمية',
        'url' => route('departments.show', $item->department->slug) . '?type=channels'
    ];
}
    return response()->json($results);
}
public function adminLive(Request $request)
{
    $q = trim($request->q);
    $results = [];

    if (strlen($q) < 2) {
        return response()->json([]);
    }

    foreach (Book::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'كتاب رقمي',
            'url' => route('admin.digital-books.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (LibraryBook::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'كتاب ورقي',
            'url' => route('admin.books.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (Syllabus::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'منهج',
            'url' => route('admin.syllabuses.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (PastExam::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'أسئلة سنوات',
            'url' => route('admin.past-exams.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (Project::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'مشروع تخرج',
            'url' => route('admin.projects.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (Research::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'بحث علمي',
            'url' => route('admin.researches.index', [
                'search' => $item->title
            ]),
        ];
    }

    foreach (EducationalChannel::where('title', 'like', "%{$q}%")->limit(5)->get() as $item) {
        $results[] = [
            'title' => $item->title,
            'type' => 'قناة تعليمية',
            'url' => route('admin.educational-channels.index', [
                'search' => $item->title
            ]),
        ];
    }

    return response()->json($results);
}
}