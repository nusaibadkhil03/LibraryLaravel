@extends('layouts.admin')

@section('content')

<style>
.admin-form-page { padding:35px !important; direction:rtl !important; }
.admin-form-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:25px !important; }
.admin-form-card { background:#fff !important; max-width:850px !important; padding:30px !important; border-radius:18px !important; box-shadow:0 8px 25px rgba(0,0,0,0.12) !important; }
.admin-form-grid { display:grid !important; grid-template-columns:repeat(2,1fr) !important; gap:22px !important; }
.admin-field { display:flex !important; flex-direction:column !important; }
.admin-field.full { grid-column:span 2 !important; }
.admin-field label { margin-bottom:8px !important; font-weight:bold !important; }
.admin-field input, .admin-field select, .admin-field textarea {
    border:1px solid #ddd !important;
    border-radius:12px !important;
    padding:12px 15px !important;
    background:#fafafa !important;
}
.admin-save-btn, .admin-back-btn {
    background:#e67e22 !important;
    color:white !important;
    border:none !important;
    padding:12px 30px !important;
    border-radius:25px !important;
    text-decoration:none !important;
    cursor:pointer !important;
}
.admin-back-btn {
    background:white !important;
    color:#e67e22 !important;
    border:1px solid #e67e22 !important;
}
</style>

<div class="admin-form-page">

    <div class="admin-form-header">
        <h2>إضافة أسئلة سنوات</h2>

        <a href="{{ route('admin.past-exams.index') }}" class="admin-back-btn">
            رجوع
        </a>
    </div>

    <div class="admin-form-card">
        <form action="{{ route('admin.past-exams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-grid">

                <div class="admin-field">
                    <label>عنوان الملف</label>
                    <input type="text" name="title" required>
                </div>

                <div class="admin-field">
                    <label>القسم</label>
                    <select name="department_id" required>
                        <option value="">اختر القسم</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-field">
                    <label>اسم المادة</label>
                    <input type="text" name="subject_name">
                </div>

                <div class="admin-field">
                    <label>اسم الدكتور</label>
                    <input type="text" name="doctor_name">
                </div>

                <div class="admin-field">
                    <label>السنة الدراسية</label>
                    <input type="text" name="academic_year" placeholder="مثال: 2025-2026">
                </div>

                <div class="admin-field">
                    <label>الفصل الدراسي</label>
                    <select name="semester">
                        <option value="">اختر الفصل</option>
                        <option value="fall">خريف</option>
                        <option value="spring">ربيع</option>
                        <option value="summer">صيف</option>
                    </select>
                </div>

                <div class="admin-field">
                    <label>سنة الامتحان</label>
                    <input type="text" name="exam_year" placeholder="مثال: 2025">
                </div>

                <div class="admin-field">
                    <label>الملف</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                </div>

                <div class="admin-field full">
                    <label>الوصف</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

            </div>

            <button type="submit" class="admin-save-btn">
                حفظ
            </button>
        </form>
    </div>

</div>

@endsection