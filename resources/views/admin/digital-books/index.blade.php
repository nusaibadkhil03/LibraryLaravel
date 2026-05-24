@extends('layouts.admin')

@section('page_title', 'الكتب الرقمية')

@section('content')

<style>
    .admin-page-header{
    display:flex !important;
    justify-content:space-between !important;
    align-items:center !important;
    margin-bottom:25px !important;
    flex-wrap:wrap !important;
    gap:15px !important;
}

.admin-header-actions{
    display:flex !important;
    align-items:center !important;
    gap:12px !important;
    flex-wrap:wrap !important;
}

.admin-filter-form{
    display:flex !important;
    gap:10px !important;
    align-items:center !important;
}

.admin-filter-form select{
    padding:11px 15px !important;
    border:1px solid #ddd !important;
    border-radius:12px !important;
    background:white !important;
    min-width:170px !important;
    font-family:inherit !important;
}

.admin-filter-form select:focus{
    border-color:#e67e22 !important;
    outline:none !important;
}

.admin-add-btn{
    background:#e67e22 !important;
    color:white !important;
    text-decoration:none !important;
    padding:12px 22px !important;
    border-radius:12px !important;
    font-weight:bold !important;
    display:inline-flex !important;
    align-items:center !important;
}

.admin-add-btn:hover{
    background:#cf711f !important;
}
.admin-digital-page {
    padding: 35px !important;
    direction: rtl !important;
}

.admin-page-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 25px !important;
}

.admin-page-header h2 {
    color: #e67e22 !important;
    font-size: 28px !important;
    margin: 0 !important;
}

.success-message {
    background: #eaf8ee !important;
    color: #218838 !important;
    padding: 12px 18px !important;
    border-radius: 12px !important;
    margin-bottom: 18px !important;
    text-align: center !important;
}

.admin-form-card,
.admin-table-card {
    background: #fff !important;
    border-radius: 18px !important;
    padding: 28px !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.10) !important;
    margin-bottom: 28px !important;
}

.admin-form-grid {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
}

.admin-field {
    display: flex !important;
    flex-direction: column !important;
}

.admin-field.full {
    grid-column: span 2 !important;
}

.admin-field label {
    margin-bottom: 8px !important;
    font-weight: bold !important;
    color: #333 !important;
}

.admin-field input,
.admin-field select,
.admin-field textarea {
    width: 100% !important;
    border: 1px solid #ddd !important;
    border-radius: 12px !important;
    padding: 12px 15px !important;
    background: #fafafa !important;
    outline: none !important;
    font-family: inherit !important;
    font-size: 15px !important;
}

.admin-field input:focus,
.admin-field select:focus,
.admin-field textarea:focus {
    border-color: #e67e22 !important;
    background: #fff !important;
}

.admin-upload-btn {
    margin-top: 22px !important;
    background: #e67e22 !important;
    color: white !important;
    border: none !important;
    padding: 12px 35px !important;
    border-radius: 25px !important;
    font-size: 16px !important;
    font-weight: bold !important;
    cursor: pointer !important;
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
    min-width: 90px !important;
    background: #2c7be5 !important;
    color: white !important;
    padding: 8px 14px !important;
    border-radius: 20px !important;
    text-decoration: none !important;
    white-space: nowrap !important;
}

.empty-message {
    text-align: center !important;
    color: #999 !important;
    margin: 0 !important;
}
</style>

<div class="admin-digital-page">

    <div class="admin-page-header">

    <h2>إدارة الكتب الرقمية PDF</h2>

    <div class="admin-header-actions">

        <form method="GET"
              action="{{ route('admin.digital-books.index') }}"
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

                <option value="oldest"
                    {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    الأقدم أولاً
                </option>

                <option value="title"
                    {{ request('sort') == 'title' ? 'selected' : '' }}>
                    ترتيب أبجدي
                </option>

            </select>

        </form>

        <a href="{{ route('admin.digital-books.create') }}"
           class="admin-add-btn">

            + إضافة كتاب رقمي

        </a>

    </div>

</div>

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

    <div class="admin-table-card">
        @if($books->count())
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>القسم</th>
                        <th>الفصل</th>
                        <th>الملف</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->department->name ?? '-' }}</td>
                            <td>{{ $book->semester ?? '-' }}</td>
                            <td>
                                @if($book->file_path)
                                    <a href="{{ asset('storage/' . $book->file_path) }}"
                                       target="_blank"
                                       class="file-btn">
                                        فتح PDF
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>

    <form method="POST"
          action="{{ route('admin.digital-books.destroy', $book->id) }}"
          onsubmit="return confirm('هل أنت متأكد من حذف الكتاب؟')">

        @csrf
        @method('DELETE')

        <button type="submit"
            style="
                background:#dc3545;
                color:white;
                border:none;
                padding:8px 14px;
                border-radius:8px;
                cursor:pointer;
                font-weight:bold;
            ">
            حذف
        </button>

    </form>

</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="empty-message">لا توجد كتب رقمية حالياً.</p>
        @endif
    </div>

</div>

@endsection