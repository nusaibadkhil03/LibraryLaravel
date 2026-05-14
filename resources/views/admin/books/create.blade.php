@extends('layouts.admin')

@section('page_title', 'إضافة كتاب')

@section('content')

<div class="section-box">

    <h2>إضافة كتاب جديد</h2>
    <div style="margin:20px 0;">

    <a href="{{ route('admin.books.index') }}">

        <button style="
            background:#6c757d;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            cursor:pointer;
        ">
            عرض الكتب
        </button>

    </a>

</div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

   <form method="POST" action="{{ route('admin.books.store') }}" style="margin:20px 0;">
        @csrf

        <input type="text" name="title" placeholder="عنوان الكتاب" required style="padding:10px; margin:5px;">

        <input type="text" name="author" placeholder="المؤلف" style="padding:10px; margin:5px;">

        <input type="text" name="publisher" placeholder="الناشر" style="padding:10px; margin:5px;">

        <input type="number" name="publication_year" placeholder="سنة النشر" style="padding:10px; margin:5px;">

        <input type="text" name="publication_place" placeholder="مكان النشر" style="padding:10px; margin:5px;">

        <input type="text" name="book_number" placeholder="رقم الكتاب / التسجيل" style="padding:10px; margin:5px;">

        <input type="text" name="edition_number" placeholder="رقم الطبعة" style="padding:10px; margin:5px;">

        <input type="text" name="shelf_location" placeholder="مكان الرف" style="padding:10px; margin:5px;">

        <select name="department_id" required style="padding:10px; margin:5px;">
            <option value="">اختر القسم</option>

            @foreach($departments as $department)
                <option value="{{ $department->id }}">
                    {{ $department->name }}
                </option>
            @endforeach
        </select>

        <input type="number"
               name="total_copies"
               placeholder="عدد النسخ"
               required
               min="1"
               style="padding:10px; margin:5px;">

        <button type="submit" class="admin-logout-btn">
            إضافة كتاب
        </button>
    </form>

</div>

@endsection