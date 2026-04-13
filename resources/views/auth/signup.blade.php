@extends('layouts.form_layout')

@section('title', 'إنشاء حساب - مكتبة الجامعة')

@section('form_body')

<h2>إنشاء حساب</h2>

<p class="note">
ملاحظة: يجب استخدام البريد الجامعي
</p>

<form action="{{ url('/signup') }}" method="POST">
    @csrf
    <div class="form-row">
    <div class="form-group">
        <label>اسم الطالب</label>
        <input type="text" name="student_name" placeholder="الاسم الكامل" required>
    </div>

    <div class="form-group">
        <label>رقم القيد</label>
        <input type="text" name="student_id" placeholder="رقم القيد" required>
    </div>
</div>
    <label>القسم</label>
    <select name="department" required>
        <option value="">-- اختر القسم --</option>
        <option value="cs">الحاسب الآلي</option>
        <option value="arch">الهندسة المعمارية</option>
        <option value="petroleum">هندسة النفط</option>
        <option value="law">القانون</option>
        <option value="accounting">المحاسبة</option>
        <option value="business">إدارة الأعمال</option>
    </select>
     

    <label>البريد الجامعي</label>
    <input type="email" name="email" placeholder="xxxxxxx@libyanuniv.edu.ly" required>

    <label>كلمة المرور</label>
    <input type="password" name="password" required>

    <label>إعادة كلمة المرور</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit" class="login-btn">
        إنشاء حساب
    </button>

</form>

<!-- رابط تسجيل الدخول -->
<p style="text-align:center; margin-top:15px;">
    لديك حساب بالفعل؟
    <a href="{{ url('/login') }}">تسجيل الدخول</a>
</p>

@endsection