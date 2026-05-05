@extends('layouts.admin')

@section('content')

<style>
.admin-form-page { padding:35px !important; direction:rtl !important; }
.admin-form-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:25px !important; }
.admin-form-card { background:#fff !important; max-width:850px !important; padding:30px !important; border-radius:18px !important; box-shadow:0 8px 25px rgba(0,0,0,0.12) !important; }
.admin-form-grid { display:grid !important; grid-template-columns:repeat(2,1fr) !important; gap:22px !important; }
.admin-field { display:flex !important; flex-direction:column !important; }
.admin-field.full { grid-column:span 2 !important; }
.admin-field label { margin-bottom:8px !important; font-weight:bold !important; color:#333 !important; }
.admin-field input, .admin-field select, .admin-field textarea {
    border:1px solid #ddd !important;
    border-radius:12px !important;
    padding:12px 15px !important;
    background:#fafafa !important;
    font-family:inherit !important;
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
        <h2>إضافة قناة تعليمية</h2>

        <a href="{{ route('admin.educational-channels.index') }}" class="admin-back-btn">
            رجوع
        </a>
    </div>

    <div class="admin-form-card">
        <form action="{{ route('admin.educational-channels.store') }}" method="POST">
            @csrf

            <div class="admin-form-grid">
                <div class="admin-field">
                    <label>اسم القناة</label>
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
                    <label>نوع المنصة</label>
                    <select name="platform">
                        <option value="">اختر المنصة</option>
                        <option value="YouTube">YouTube</option>
                        <option value="Telegram">Telegram</option>
                        <option value="Website">Website</option>
                        <option value="Other">أخرى</option>
                    </select>
                </div>

                <div class="admin-field">
                    <label>رابط القناة</label>
                    <input type="url" name="channel_url" placeholder="https://example.com" required>
                </div>

                <div class="admin-field full">
                    <label>الوصف</label>
                    <textarea name="description" rows="4"></textarea>
                </div>
            </div>

            <button type="submit" class="admin-save-btn">
                حفظ القناة
            </button>
        </form>
    </div>
</div>

@endsection