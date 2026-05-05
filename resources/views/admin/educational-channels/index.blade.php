@extends('layouts.admin')

@section('content')

<style>
.admin-table-page { padding:35px !important; direction:rtl !important; }
.admin-table-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:25px !important; }
.admin-add-btn {
    background:#e67e22 !important;
    color:white !important;
    padding:10px 22px !important;
    border-radius:25px !important;
    text-decoration:none !important;
    font-weight:bold !important;
}
.admin-table-card {
    background:#fff !important;
    border-radius:18px !important;
    padding:25px !important;
    box-shadow:0 8px 25px rgba(0,0,0,0.10) !important;
    overflow-x:auto !important;
}
.admin-table { width:100% !important; border-collapse:collapse !important; }
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
.empty-table { text-align:center !important; color:#999 !important; padding:25px !important; }
</style>

<div class="admin-table-page">

    <div class="admin-table-header">
        <h2>القنوات التعليمية</h2>

        <a href="{{ route('admin.educational-channels.create') }}" class="admin-add-btn">
            + إضافة قناة
        </a>
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
                            <a href="{{ $item->channel_url }}" target="_blank" class="link-btn">
                                فتح الرابط
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.educational-channels.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه القناة؟')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-table">لا توجد قنوات تعليمية حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection