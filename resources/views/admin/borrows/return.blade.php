@extends('layouts.admin')

@section('page_title', 'تأكيد إرجاع الكتاب')

@section('content')

<div class="section-box">

    <h2>تأكيد إرجاع الكتاب</h2>

    <div style="background:#fff; padding:20px; border-radius:16px; margin-bottom:20px; box-shadow:0 4px 14px rgba(0,0,0,0.08);">

        <p><strong>اسم الطالب:</strong> {{ $borrow->student_name ?? $borrow->user->name ?? '-' }}</p>
        <p><strong>رقم القيد:</strong> {{ $borrow->student_number ?? $borrow->user->student_number ?? '-' }}</p>
        <p><strong>اسم الكتاب:</strong> {{ $borrow->libraryBook->title ?? '-' }}</p>
        <p><strong>تاريخ الإرجاع المتوقع:</strong> {{ $borrow->due_date ?? '-' }}</p>

    </div>

    <form method="POST" action="{{ route('admin.borrows.return', $borrow->id) }}">
        @csrf

        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px;">

            <div>
                <label>تاريخ الإرجاع الفعلي</label>
                <input type="date"
                       name="actual_return_date"
                       value="{{ date('Y-m-d') }}"
                       required
                       style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
            </div>

            <div>
                <label>قيمة الغرامة</label>
                <input type="number"
                       name="fine_amount"
                       value="0"
                       min="0"
                       step="0.01"
                       style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:8px; margin-top:12px;">
                    <input type="checkbox" name="is_late" value="1">
                    يوجد تأخير في الإرجاع
                </label>
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:8px; margin-top:12px;">
                    <input type="checkbox" name="fine_paid" value="1">
                    تم دفع الغرامة
                </label>
            </div>

            <div style="grid-column:span 2;">
                <label>ملاحظات الإرجاع</label>
                <textarea name="return_notes"
                          rows="4"
                          placeholder="اكتب أي ملاحظات عن حالة الكتاب أو الغرامة..."
                          style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;"></textarea>
            </div>

        </div>

        <div style="margin-top:25px; display:flex; gap:10px;">
            <button type="submit" style="
                background:#007bff;
                color:white;
                border:none;
                padding:12px 25px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;">
                تأكيد الإرجاع
            </button>

            <a href="{{ route('admin.borrows.index') }}" style="
                background:#6c757d;
                color:white;
                text-decoration:none;
                padding:12px 25px;
                border-radius:10px;
                font-weight:bold;">
                رجوع
            </a>
        </div>

    </form>

</div>

@endsection