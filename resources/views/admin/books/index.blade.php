@extends('layouts.admin')

@section('page_title', 'إدارة الكتب الورقية')

@section('content')
<style>
   .admin-card {
    background: #fff;
    border-radius: 18px; /* 👈 هذا المهم */
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}
 input,
select {
    border-radius: 12px; /* 👈 ناعم */
    border: 1px solid #ddd;
    padding: 10px 14px;
    background: #fafafa;
}

input:focus,
select:focus {
    border-color: #e67e22;
    background: #fff;
}
table {
    border-radius: 15px;
    overflow: hidden; /* 👈 يخلي الزوايا تنطبق */
}
</style>
<div class="section-box">

    <h2>إدارة الكتب الورقية</h2>

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
        <input type="text" name="shelf_location" placeholder="مكان الرف" style="padding:10px; margin:5px;">

        <select name="department_id" required style="padding:10px; margin:5px;">
            <option value="">اختر القسم</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>

        <input type="number" name="total_copies" placeholder="عدد النسخ" required min="1" style="padding:10px; margin:5px;">

        <button type="submit" class="admin-logout-btn">إضافة كتاب</button>
    </form>

    @if($books->count())
        <table style="width:100%; margin-top:20px; border-collapse: collapse;">
            <thead>
                <tr style="background:#eee;">
                    <th style="padding:10px;">#</th>
                    <th style="padding:10px;">العنوان</th>
                    <th style="padding:10px;">المؤلف</th>
                    <th style="padding:10px;">الناشر</th>
                    <th style="padding:10px;">سنة النشر</th>
                    <th style="padding:10px;">رقم التسجيل</th>
                    <th style="padding:10px;">القسم</th>
                    <th style="padding:10px;">النسخ المتاحة</th>
                    <th style="padding:10px;">الحالة</th>
                </tr>
            </thead>

            <tbody>
                @foreach($books as $book)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $book->id }}</td>
                        <td style="padding:10px;">{{ $book->title }}</td>
                        <td style="padding:10px;">{{ $book->author ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->publisher ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->publication_year ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->book_number ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->department->name ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->available_copies }}</td>
                        <td style="padding:10px;">{{ $book->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="margin-top:20px;">لا توجد كتب حالياً.</p>
    @endif

</div>
@endsection