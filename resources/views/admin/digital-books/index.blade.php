@extends('layouts.admin')

@section('page_title', 'الكتب الرقمية')

@section('content')

<div class="section-box">

    <h2>إدارة الكتب الرقمية (PDF)</h2>

    <!-- رسالة نجاح -->
    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <!-- فورم إضافة كتاب -->
    <form method="POST"
          action="{{ route('admin.digital-books.store') }}"
          enctype="multipart/form-data"
          style="margin:20px 0;">

        @csrf

        <input type="text" name="title" placeholder="اسم الكتاب" required style="padding:10px; margin:5px;">

        <input type="text" name="author" placeholder="المؤلف" style="padding:10px; margin:5px;">

        <select name="department_id" required style="padding:10px; margin:5px;">
            <option value="">اختر القسم</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>

        <input type="text" name="semester" placeholder="الفصل الدراسي" style="padding:10px; margin:5px;">

        <input type="file" name="file" accept="application/pdf" required style="padding:10px; margin:5px;">

        <br>

        <textarea name="description" placeholder="وصف الكتاب"
                  style="padding:10px; margin:5px; width:300px;"></textarea>

        <br>

        <button type="submit" class="admin-logout-btn">
            رفع كتاب PDF
        </button>
    </form>

    <!-- جدول الكتب -->
    @if($books->count())
        <table style="width:100%; margin-top:20px; border-collapse: collapse;">
            <thead>
                <tr style="background:#eee;">
                    <th style="padding:10px;">#</th>
                    <th style="padding:10px;">العنوان</th>
                    <th style="padding:10px;">القسم</th>
                    <th style="padding:10px;">الفصل</th>
                    <th style="padding:10px;">الملف</th>
                </tr>
            </thead>

            <tbody>
                @foreach($books as $book)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $book->id }}</td>
                        <td style="padding:10px;">{{ $book->title }}</td>
                        <td style="padding:10px;">{{ $book->department->name ?? '-' }}</td>
                        <td style="padding:10px;">{{ $book->semester ?? '-' }}</td>
                        <td style="padding:10px;">
                            @if($book->file_path)
                                <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank">
                                    فتح PDF
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="margin-top:20px;">لا توجد كتب رقمية حالياً.</p>
    @endif

</div>

@endsection