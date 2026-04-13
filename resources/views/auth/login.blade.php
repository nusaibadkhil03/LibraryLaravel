@extends('layouts.form_layout')

@section('title', 'تسجيل الدخول - مكتبة الجامعة')

@section('form_body')
    <h2>تسجيل الدخول</h2>
    <p class="note">ملاحظة: يجب تسجيل الدخول باستخدام البريد الجامعي</p>

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <label>البريد الجامعي</label>
        <input type="email" name="email" placeholder="xxxxxxx@libyanuniv.edu.ly" required>

        <label>كلمة المرور</label>
        <input type="password" name="password" required>

        <button type="submit" class="login-btn">تسجيل الدخول</button>
    </form>
@endsection