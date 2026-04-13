@extends('layouts.form_layout')

@section('title', 'الملف الشخصي - مكتبة الجامعة')

@section('form_body')

<h2>الملف الشخصي</h2>

<p class="note">
يمكنك تعديل بياناتك الشخصية من هنا
</p>

@if (session('status') === 'profile-updated')
    <p style="color: green; text-align: center; margin-bottom: 15px;">
        تم تحديث البيانات بنجاح
    </p>
@endif

<!-- ✅ البيانات الشخصية -->
<div class="form-section">
    <h3>البيانات الشخصية</h3>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label>اسم الطالب</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>البريد الإلكتروني</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="login-btn">حفظ التعديلات</button>
    </form>
</div>

<!-- 🔐 تغيير كلمة المرور -->
<div class="form-section">
    <h3>تغيير كلمة المرور</h3>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <label>كلمة المرور الحالية</label>
        <input type="password" name="current_password">

        @error('current_password', 'updatePassword')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>كلمة المرور الجديدة</label>
        <input type="password" name="password">

        @error('password', 'updatePassword')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>تأكيد كلمة المرور الجديدة</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="login-btn">تحديث كلمة المرور</button>
    </form>
</div>

<!-- 🗑️ حذف الحساب -->
<div class="form-section">
    <h3 style="color:#c0392b;">حذف الحساب</h3>

    <p class="note">
        عند حذف الحساب سيتم حذف جميع البيانات المرتبطة به نهائيًا.
    </p>

    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <label>أدخل كلمة المرور لتأكيد الحذف</label>
        <input type="password" name="password" required>

        @error('password', 'userDeletion')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="login-btn" style="background:#c0392b;">
            حذف الحساب
        </button>
    </form>
</div>

<p style="text-align:center; margin-top:15px;">
    <a href="{{ url('/') }}">الرجوع إلى الصفحة الرئيسية</a>
</p>

@endsection