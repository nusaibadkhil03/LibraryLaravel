@extends('layouts.borrow_layout')

@section('title', 'استعارة كتاب')

@section('content')

<div class="borrow-container">

    <div class="tabs" id="main-tabs">
        <button type="button" class="tab-btn active" onclick="showTab('request-form-container', this)">طلب استعارة</button>
        <button type="button" class="tab-btn" onclick="showTab('status-view', this)">حالة الطلب</button>
    </div>

    <div id="request-form-container" class="form-section active">

        <h2>تقديم طلب استعارة</h2>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('borrow.store') }}">
            @csrf

            <div class="form-grid">
                <div class="input-box">
                    <label>اسم الطالب *</label>
                    <input type="text" name="student_name" placeholder="أدخل اسمك الكامل" required>
                </div>

                <div class="input-box">
                    <label>رقم القيد *</label>
                    <input type="text" name="student_id" placeholder="مثال: 202012345" required>
                </div>
            </div>

            <div class="input-box">
                <label>اسم الكتاب *</label>
                <select name="book_id" required style="padding:10px;">
                    <option value="">اختر كتاب</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>اسم المؤلف</label>
                    <input type="text" name="author">
                </div>

                <div class="input-box">
                    <label>رقم الطبعة</label>
                    <input type="text" name="edition">
                </div>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>تاريخ الاستعارة</label>
                    <input type="date" id="borrow_date">
                </div>

                <div class="input-box">
                    <label>تاريخ الإرجاع</label>
                    <input type="text" id="return_date_display" readonly>
                </div>
            </div>

            <button type="submit" class="tab-btn active">إرسال الطلب</button>
        </form>
    </div>
<div id="status-view" class="form-section" style="display:none;">
    <h2>متابعة حالة الطلب</h2>

    @if(isset($borrows) && $borrows->count())
        @foreach($borrows as $borrow)

        <div style="
            background:#fff;
            padding:15px;
            margin-bottom:10px;
            border-radius:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        ">

            <p style="font-weight:bold;">
                📘 {{ $borrow->libraryBook->title ?? '-' }}
            </p>

            @if($borrow->status == 'pending')
                <span style="color:#e67e22; font-weight:bold;">⏳ قيد المراجعة</span>

            @elseif($borrow->status == 'approved')
                <span style="color:green; font-weight:bold;">✅ تمت الموافقة</span>

            @elseif($borrow->status == 'rejected')
                <span style="color:red; font-weight:bold;">❌ مرفوض</span>

            @endif

        </div>

        @endforeach
    @else
        <p>لا توجد طلبات حالياً</p>
    @endif

</div>
    
    </div>

</div>

@endsection

@section('scripts')
<script>
function showTab(sectionId, button) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.style.display = 'none';
        section.classList.remove('active');
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = 'block';
        section.classList.add('active');
    }

    button.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("borrow_date");
    const output = document.getElementById("return_date_display");

    if (!input || !output) return;

    input.addEventListener("input", function () {
        if (!input.value) return;

        let borrowDate = new Date(input.value);
        borrowDate.setDate(borrowDate.getDate() + 14);

        const year = borrowDate.getFullYear();
        const month = String(borrowDate.getMonth() + 1).padStart(2, '0');
        const day = String(borrowDate.getDate()).padStart(2, '0');

        output.value = `${year}-${month}-${day}`;
    });
});
</script>
@endsection