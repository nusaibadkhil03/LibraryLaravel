@extends('layouts.admin')

@section('content')

<h2>إدارة الخطة الدراسية</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('admin.curriculum.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <select name="type">
        <option value="schedule">الجداول الدراسية</option>
        <option value="plan">الخطة الدراسية</option>
        <option value="calendar">التقويم الأكاديمي</option>
    </select>

    <input type="file" name="image">
    <button type="submit">رفع</button>
</form>

<hr>

<h3>الجداول الدراسية</h3>
@foreach($schedules as $item)
    <img src="{{ asset('storage/'.$item->image) }}" width="120">
    <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>
@endforeach

<h3>الخطة الدراسية</h3>
@foreach($plans as $item)
    <img src="{{ asset('storage/'.$item->image) }}" width="120">
    <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>
@endforeach

<h3>التقويم الأكاديمي</h3>
@foreach($calendars as $item)
    <img src="{{ asset('storage/'.$item->image) }}" width="120">
    <form method="POST" action="{{ route('admin.curriculum.destroy', $item->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>
@endforeach

@endsection