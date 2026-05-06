@extends('layouts.main')

@section('content')

<h2>نتائج البحث عن: "{{ $q }}"</h2>

<h3>📚 الكتب</h3>
@forelse($books as $book)
    <p>{{ $book->title }}</p>
@empty
    <p>لا توجد نتائج</p>
@endforelse

<h3>🎓 المشاريع</h3>
@forelse($projects as $project)
    <p>{{ $project->title }}</p>
@empty
    <p>لا توجد نتائج</p>
@endforelse

@endsection