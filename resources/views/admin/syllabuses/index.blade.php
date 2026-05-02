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
</style>

<div class="admin-table-page">

    <div class="admin-table-header">
        <h2>إدارة المناهج</h2>

        <a href="{{ route('admin.syllabuses.create') }}" class="admin-add-btn">
            + إضافة منهج
        </a>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان المنهج</th>
                    <th>القسم</th>
                    <th>السنة الدراسية</th>
                    <th>الفصل</th>
                    <th>الملف</th>
                    <th>الحالة</th>
                    <th>إجراء</th>
                </tr>
            </thead>

            <tbody>
                @forelse($syllabuses as $index => $item)
                    @php
                        $semesterNames = [
                            'fall' => 'خريف',
                            'spring' => 'ربيع',
                            'summer' => 'صيف',
                            'first' => 'الأول',
                            'second' => 'الثاني',
                            'full_year' => 'سنة كاملة',
                        ];

                        $statusNames = [
                            'published' => 'منشور',
                            'hidden' => 'مخفي',
                            'archived' => 'مؤرشف',
                        ];
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name ?? '-' }}</td>
                        <td>{{ $item->academic_year ?? '-' }}</td>
                        <td>{{ $semesterNames[$item->semester] ?? '-' }}</td>

                        <td>
                            @if($item->file_path)
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="file-btn">
                                    عرض الملف
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $statusNames[$item->status] ?? '-' }}</td>

                        <td>
                            <form action="{{ route('admin.syllabuses.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا المنهج؟')">
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
                        <td colspan="8" class="empty-table">
                            لا توجد مناهج مضافة حالياً.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection