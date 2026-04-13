@extends('layouts.form_layout')

@section('title', 'إنشاء حساب - مكتبة الجامعة')

@section('form_body')

<h2>إنشاء حساب</h2>

<p class="note">
ملاحظة: يجب استخدام البريد الجامعي
</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">اسم الطالب</label>
    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name') }}"
        placeholder="الاسم الكامل"
        required
        autofocus
        autocomplete="name"
    >
    @error('name')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="email">البريد الجامعي</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="xxxxxxx@libyanuniv.edu.ly"
        required
        autocomplete="username"
    >
    @error('email')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password">كلمة المرور</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="أدخل كلمة المرور"
        required
        autocomplete="new-password"
    >
    @error('password')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password_confirmation">إعادة كلمة المرور</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="أعد كتابة كلمة المرور"
        required
        autocomplete="new-password"
    >
    @error('password_confirmation')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <button type="submit" class="login-btn">
        إنشاء حساب
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    لديك حساب بالفعل؟
    <a href="{{ route('login') }}">تسجيل الدخول</a>
</p>

@endsection