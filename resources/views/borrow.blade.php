@extends('layouts.borrow_layout')

@section('title', 'استعارة كتاب')

@section('content')

<div class="borrow-container">

    <div class="tabs" id="main-tabs">
        <button class="tab-btn active" onclick="showTab('request-form-container')">طلب استعارة</button>
        <button class="tab-btn" onclick="showTab('status-view')">حالة الطلب</button>
    </div>

    <div id="request-form-container" class="form-section active">

        <h2>تقديم طلب استعارة</h2>

        <form id="borrowForm">

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
        <input type="text" name="book_name" placeholder="أدخل اسم الكتاب" required>
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
            <input type="text" id="return_date_display" readonly
        </div>

    </div>

    <button type="submit" class="tab-btn active">إرسال الطلب</button>

</form>
    </div>

    <div id="status-view" class="form-section" style="display:none;">
        <h2>متابعة حالة الطلب</h2>

        <div class="status-card">
            <p>📘 مقدمة في الخوارزميات</p>
            <span class="status-badge pending">قيد المراجعة</span>
        </div>
    </div>

</div>

@endsection


@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("borrow_date");
    const output = document.getElementById("return_date_display");

    if (!input || !output) {
        console.log("inputs not found");
        return;
    }

    input.addEventListener("input", function () {

        console.log("date changed:", input.value);

        if (!input.value) return;

        let borrowDate = new Date(input.value);

        // إضافة 14 يوم
        borrowDate.setDate(borrowDate.getDate() + 14);

        const year = borrowDate.getFullYear();
        const month = String(borrowDate.getMonth() + 1).padStart(2, '0');
        const day = String(borrowDate.getDate()).padStart(2, '0');

        output.value = `${year}-${month}-${day}`;

        console.log("return date:", output.value);
    });

});

</script> 
@endsection