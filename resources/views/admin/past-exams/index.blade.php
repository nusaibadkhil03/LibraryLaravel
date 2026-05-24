@extends('layouts.admin')

@section('content')
<style>
.admin-table-page {
    padding: 35px !important;
    direction: rtl !important;
}

.admin-table-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 25px !important;
}

.admin-table-header h2 {
    margin: 0 !important;
    color: #333 !important;
}

.admin-add-btn {
    background: #e67e22 !important;
    color: white !important;
    padding: 10px 22px !important;
    border-radius: 25px !important;
    text-decoration: none !important;
    font-weight: bold !important;
}

.admin-table-card {
    background: #fff !important;
    border-radius: 18px !important;
    padding: 25px !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.10) !important;
    overflow-x: auto !important;
}

.admin-table {
    width: 100% !important;
    border-collapse: collapse !important;
}

.admin-table th {
    background: #e67e22 !important;
    color: white !important;
    padding: 14px !important;
    text-align: center !important;
}

.admin-table td {
    padding: 13px !important;
    text-align: center !important;
    border-bottom: 1px solid #eee !important;
    color: #333 !important;
}

.admin-table tr:hover {
    background: #fff7f0 !important;
}

.file-btn {
    display: inline-block !important;
    min-width: 95px !important;
    background: #2c7be5 !important;
    color: white !important;
    padding: 8px 14px !important;
    border-radius: 20px !important;
    text-decoration: none !important;
    font-size: 14px !important;
    white-space: nowrap !important;
    text-align: center !important;
}

.delete-btn {
    background: #dc3545 !important;
    color: white !important;
    border: none !important;
    padding: 7px 15px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
}

.success-message {
    background: #eaf8ee !important;
    color: #218838 !important;
    padding: 12px 18px !important;
    border-radius: 12px !important;
    margin-bottom: 18px !important;
}

.empty-table {
    text-align: center !important;
    color: #999 !important;
    padding: 25px !important;
}

.admin-header-actions {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    flex-wrap: wrap !important;
}

.admin-filter-form {
    display: flex !important;
    gap: 10px !important;
    align-items: center !important;
}

.admin-filter-form select {
    padding: 11px 15px !important;
    border: 1px solid #ddd !important;
    border-radius: 12px !important;
    background: white !important;
    min-width: 170px !important;
    font-family: inherit !important;
}
</style>
<div class="section-box">

    <div class="admin-page-header">

        <h2>أسئلة السنوات</h2>

        <div class="admin-header-actions">

            <form method="GET"
                  action="{{ route('admin.past-exams.index') }}"
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

            <a href="{{ route('admin.past-exams.create') }}"
               class="admin-add-btn">
                + إضافة جديد
            </a>

        </div>

    </div>

    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if($pastExams->count())
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>القسم</th>
                    <th>السنة</th>
                    <th>الفصل</th>
                    <th>الدكتور</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pastExams as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->academic_year ?? '-' }}</td>
                        <td>{{ $item->semester ?? '-' }}</td>
                        <td>{{ $item->doctor_name ?? '-' }}</td>

                        <td>
                            @if($item->file_path)
                                <a href="{{ asset('storage/'.$item->file_path) }}"
                                   target="_blank">
                                    عرض
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.past-exams.destroy', $item->id) }}"
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
        <p>لا توجد بيانات</p>
    @endif

</div>

@endsection