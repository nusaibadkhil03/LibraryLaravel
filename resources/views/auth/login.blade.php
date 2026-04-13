@extends('layouts.form_layout')

@section('title', 'تسجيل الدخول - مكتبة الجامعة')

@section('form_body')

<h2>تسجيل الدخول</h2>

<p class="note">
أدخل بريدك الإلكتروني وكلمة المرور للدخول إلى حسابك
</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">البريد الإلكتروني</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="example@libyanuniv.edu.ly"
        required
        autofocus
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
        autocomplete="current-password"
    >
    @error('password')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <div style="margin-bottom: 15px;">
        <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
            <input type="checkbox" name="remember" style="width: auto; margin: 0;">
            تذكرني
        </label>
    </div>

    @if (Route::has('password.request'))
        <p style="text-align: center; margin-bottom: 15px;">
            <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
        </p>
    @endif

    <button type="submit" class="login-btn">
        تسجيل الدخول
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    ليس لديك حساب؟
    <a href="{{ route('register') }}">إنشاء حساب</a>
</p>

@endsection