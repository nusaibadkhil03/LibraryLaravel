@extends('layouts.admin')

@section('page_title', 'إدارة الكتب الورقية')

@section('content')

<style>
.admin-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

input,
select {
    border-radius: 12px;
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
    overflow: hidden;
}
</style>
<div class="section-box">

    <h2>إدارة الكتب الورقية</h2>

    <div style="margin:20px 0;">
        <a href="{{ route('admin.books.create') }}">
            <button type="button" style="
                background:#e67e22;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;
            ">
                + إضافة كتاب جديد
            </button>
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    

    {{-- جدول الكتب --}}
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
                    <th style="padding:10px;">التصنيف</th>

                    <th style="padding:10px;">رقم الطبعة</th>

                    <th style="padding:10px;">القسم</th>

                    <th style="padding:10px;">العدد الكلي</th>

                    <th style="padding:10px;">النسخ المتاحة</th>

                    <th style="padding:10px;">النسخ المستعارة</th>

                    <th style="padding:10px;">الحالة</th>

                    <th>حذف</th>

                </tr>
            </thead>

            <tbody>

                @foreach($books as $book)

                    <tr style="border-bottom:1px solid #ddd;">

                        <td style="padding:10px;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->title }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->author ?? '-' }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->publisher ?? '-' }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->publication_year ?? '-' }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->book_number ?? '-' }}
                        </td>

                        <td style="padding:10px;">
    {{ $book->category_name ?? '-' }}
</td>

                        <td style="padding:10px;">
                            {{ $book->edition_number ?? '-' }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->department->name ?? '-' }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->total_copies }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->available_copies }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->total_copies - $book->available_copies }}
                        </td>

                        <td style="padding:10px;">
                            {{ $book->status }}
                        </td>

                        <td>
    <form action="{{ route('admin.books.destroy', $book->id) }}"
          method="POST"
          onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">

        @csrf
        @method('DELETE')

        <button style="
            background:red;
            color:white;
            border:none;
            padding:8px 12px;
            border-radius:8px;
            cursor:pointer;">
            حذف
        </button>
    </form>
</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p style="margin-top:20px;">
            لا توجد كتب حالياً.
        </p>

    @endif

</div>

@endsection