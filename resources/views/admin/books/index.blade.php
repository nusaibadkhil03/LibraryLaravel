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

    
    <form method="GET" action="{{ route('admin.books.index') }}" style="
    background:#fff;
    padding:18px;
    border-radius:16px;
    margin:20px 0;
    box-shadow:0 4px 14px rgba(0,0,0,0.06);
">

    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap:12px;
        align-items:end;
    ">

        <div>
            <label>بحث</label>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="العنوان، المؤلف، الناشر، رقم التسجيل"
                   style="width:100%;">
        </div>

        <div>
            <label>القسم</label>
            <select name="department_id" style="width:100%;">
                <option value="">كل الأقسام</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ request('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>التصنيف</label>
            <input type="text"
                   name="category_name"
                   value="{{ request('category_name') }}"
                   placeholder="اكتب التصنيف"
                   style="width:100%;">
        </div>

        <div>
            <label>سنة النشر</label>
            <input type="number"
                   name="publication_year"
                   value="{{ request('publication_year') }}"
                   placeholder="مثال: 2024"
                   style="width:100%;">
        </div>

        <div>
            <label>الحالة</label>
            <select name="status" style="width:100%;">
                <option value="">كل الحالات</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                    متاح
                </option>
                <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>
                    غير متاح
                </option>
            </select>
        </div>

        <div>
            <label>الترتيب</label>
            <select name="sort" style="width:100%;">
                <option value="">الأحدث</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    الأقدم
                </option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>
                    العنوان
                </option>
                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>
                    سنة النشر الأحدث
                </option>
                <option value="copies_desc" {{ request('sort') == 'copies_desc' ? 'selected' : '' }}>
                    الأكثر نسخًا
                </option>
                <option value="available_desc" {{ request('sort') == 'available_desc' ? 'selected' : '' }}>
                    الأكثر توفرًا
                </option>
            </select>
        </div>

        <div style="display:flex; gap:8px;">
            <button type="submit" style="
                background:#e67e22;
                color:white;
                border:none;
                padding:11px 20px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;
            ">
                تطبيق
            </button>

            <a href="{{ route('admin.books.index') }}" style="
                background:#6c757d;
                color:white;
                text-decoration:none;
                padding:11px 20px;
                border-radius:10px;
                font-weight:bold;
            ">
                إعادة ضبط
            </a>
        </div>

    </div>
</form>
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
                    <th style="padding:10px;">الوصف</th>

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
                            {{ $book->department->name ?? $book->department_name ?? '-' }}
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

<td style="padding:10px;">
    {{ \Illuminate\Support\Str::limit($book->description, 60) ?? '-' }}
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