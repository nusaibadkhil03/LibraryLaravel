@extends('layouts.form_layout')

@section('title', 'إعادة تعيين كلمة المرور - مكتبة الجامعة')

@section('form_body')

<h2>إعادة تعيين كلمة المرور</h2>

<p class="note">
    أدخل كلمة المرور الجديدة لحسابك.
</p>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <label for="email">البريد الجامعي</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email', $request->email) }}"
        placeholder="xxxxxxx@libyanuniv.edu.ly"
        required
        autofocus
        autocomplete="username"
    >
    @error('email')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password">كلمة المرور الجديدة</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="أدخل كلمة المرور الجديدة"
        required
        autocomplete="new-password"
    >
    @error('password')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <label for="password_confirmation">تأكيد كلمة المرور</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="أعد كتابة كلمة المرور الجديدة"
        required
        autocomplete="new-password"
    >
    @error('password_confirmation')
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            {{ $message }}
        </p>
    @enderror

    <button type="submit" class="login-btn">
        حفظ كلمة المرور الجديدة
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    تذكرت كلمة المرور؟
    <a href="{{ route('login') }}">تسجيل الدخول</a>
</p>

@endsection