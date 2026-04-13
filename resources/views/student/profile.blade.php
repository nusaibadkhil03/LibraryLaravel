@extends('layouts.app')

@section('content')
<div class="container">
    <h1>👤 بيانات الطالب</h1>

    <p><strong>الاسم:</strong> {{ auth()->user()->name }}</p>
    <p><strong>الإيميل:</strong> {{ auth()->user()->email }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">تسجيل خروج</button>
    </form>
</div>
@endsection