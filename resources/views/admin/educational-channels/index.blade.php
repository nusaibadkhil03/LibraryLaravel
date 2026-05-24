@extends('layouts.admin')

@section('content')

<style>
.admin-table-page {
    padding:35px !important;
    direction:rtl !important;
}

.admin-page-header {
    display:flex !important;
    justify-content:space-between !important;
    align-items:center !important;
    margin-bottom:25px !important;
    flex-wrap:wrap !important;
    gap:15px !important;
}

.admin-page-header h2 {
    color:#e67e22 !important;
    font-size:30px !important;
    margin:0 !important;
}

.admin-header-actions {
    display:flex !important;
    align-items:center !important;
    gap:12px !important;
    flex-wrap:wrap !important;
}

.admin-filter-form {
    display:flex !important;
    gap:10px !important;
    align-items:center !important;
    flex-wrap:wrap !important;
}

.admin-filter-form select {
    padding:11px 15px !important;
    border:1px solid #ddd !important;
    border-radius:12px !important;
    background:white !important;
    min-width:170px !important;
    font-family:inherit !important;
}

.admin-filter-form select:focus {
    border-color:#e67e22 !important;
    outline:none !important;
}

.admin-add-btn {
    background:#e67e22 !important;
    color:white !important;
    padding:12px 22px !important;
    border-radius:12px !important;
    text-decoration:none !important;
    font-weight:bold !important;
    display:inline-flex !important;
    align-items:center !important;
}

.admin-add-btn:hover {
    background:#cf711f !important;
}

.admin-table-card {
    background:#fff !important;
    border-radius:18px !important;
    padding:25px !important;
    box-shadow:0 8px 25px rgba(0,0,0,0.10) !important;
    overflow-x:auto !important;
}

.admin-table {
    width:100% !important;
    border-collapse:collapse !important;
}

.admin-table th {
    background:#e67e22 !important;
    color:white !important;
    padding:14px !important;
    text-align:center !important;
}

.admin-table td {
    padding:13px !important;
    text-align:center !important;
    border-bottom:1px solid #eee !important;
}

.link-btn {
    display:inline-block !important;
    background:#2c7be5 !important;
    color:white !important;
    padding:8px 14px !important;
    border-radius:20px !important;
    text-decoration:none !important;
    white-space:nowrap !important;
}

.delete-btn {
    background:#dc3545 !important;
    color:white !important;
    border:none !important;
    padding:8px 14px !important;
    border-radius:20px !important;
    cursor:pointer !important;
}

.success-message {
    background:#eaf8ee !important;
    color:#218838 !important;
    padding:12px 18px !important;
    border-radius:12px !important;
    margin-bottom:18px !important;
}

.empty-table {
    text-align:center !important;
    color:#999 !important;
    padding:25px !important;
}
</style>

<div class="admin-table-page">

    <div class="admin-page-header">

        <h2>القنوات التعليمية</h2>

        <div class="admin-header-actions">

            <form method="GET"
                  action="{{ route('admin.educational-channels.index') }}"
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

            <a href="{{ route('admin.educational-channels.create') }}"
               class="admin-add-btn">
                + إضافة قناة
            </a>

        </div>

    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم القناة</th>
                    <th>القسم</th>
                    <th>المنصة</th>
                    <th>الرابط</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                @forelse($channels as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->platform ?? '-' }}</td>

                        <td>
                            <a href="{{ $item->channel_url }}"
                               target="_blank"
                               class="link-btn">
                                فتح الرابط
                            </a>
                        </td>

                        <td>
                            <form action="{{ route('admin.educational-channels.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه القناة؟')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-table">
                            لا توجد قنوات تعليمية حالياً.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection