@extends('layouts.admin')

@section('content')
 <style>
    .admin-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 15px;
}

.admin-page-header h2 {
    color: #e67e22;
    font-size: 30px;
    margin: 0;
}

.admin-header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.admin-filter-form {
    display: flex;
    gap: 10px;
    align-items: center;
}

.admin-filter-form select {
    padding: 12px 18px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: white;
    min-width: 170px;
    font-family: inherit;
    font-size: 15px;
}

.admin-add-btn {
    background: #e67e22;
    color: white !important;
    text-decoration: none;
    padding: 13px 24px;
    border-radius: 14px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
}

.admin-add-btn:hover {
    background: #cf711f;
}
 </style>
<div class="section-box">

    <div class="admin-page-header">

        <h2>البحوث العلمية</h2>

        <div class="admin-header-actions">

            <form method="GET"
                  action="{{ route('admin.researches.index') }}"
                  class="admin-filter-form">

                <select name="department_id" onchange="this.form.submit()">
                    <option value="">كل الأقسام</option>

                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ request('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort" onchange="this.form.submit()">
                    <option value="">الأحدث أولاً</option>

                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                        الأقدم أولاً
                    </option>

                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>
                        ترتيب أبجدي
                    </option>
                </select>

            </form>

            <a href="{{ route('admin.researches.create') }}"
               class="admin-add-btn">
                + إضافة بحث
            </a>

        </div>

    </div>

    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if($researches->count())
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان البحث</th>
                    <th>القسم</th>
                    <th>الباحث</th>
                    <th>السنة</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                @foreach($researches as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->author ?? '-' }}</td>
                        <td>{{ $item->publication_year ?? '-' }}</td>

                        <td>
                            <a href="{{ asset('storage/'.$item->file_path) }}"
                               target="_blank">
                                عرض
                            </a>
                        </td>

                        <td>
                            <form action="{{ route('admin.researches.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')

                                <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>لا توجد بحوث علمية حالياً.</p>
    @endif

</div>

@endsection