@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>إضافة مجلة جديدة</h2>

    <!-- زر رجوع -->
    <a href="{{ route('admin.journals.index') }}" class="btn btn-secondary mb-3">
        ⬅ رجوع للمجلات
    </a>

    <form action="{{ route('admin.journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="section-box">

            <div class="mb-3">
                <label>عنوان المجلة</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>الإصدار</label>
                <input type="text" name="edition" class="form-control" placeholder="مثال: العدد 5">
            </div>

            <div class="mb-3">
                <label>سنة النشر</label>
                <input type="number" name="publication_year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>الناشر</label>
                <input type="text" name="publisher" class="form-control">
            </div>

            <div class="mb-3">
                <label>الوصف</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>ملف PDF</label>
                <input type="file" name="file" class="form-control" required>
            </div>

        </div>

        <button type="submit" class="btn btn-success mt-3">
            حفظ المجلة
        </button>

    </form>

</div>
@endsection