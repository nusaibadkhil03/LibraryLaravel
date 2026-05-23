@extends('layouts.form_layout')

@section('title', 'استعادة كلمة المرور - مكتبة الجامعة')

@section('form_body')

<h2>استعادة كلمة المرور</h2>

<p class="note">
    أدخل بريدك الجامعي وسنرسل لك رابطًا لإعادة تعيين كلمة المرور.
</p>

@if (session('status'))
    <p style="color: green; font-size: 14px; margin-bottom: 15px; text-align:center;">
        {{ session('status') }}
    </p>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <label for="email">البريد الجامعي</label>
    <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
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

    <button type="submit" class="login-btn">
        إرسال رابط الاستعادة
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    تذكرت كلمة المرور؟
    <a href="{{ route('login') }}">تسجيل الدخول</a>
</p>

@endsection