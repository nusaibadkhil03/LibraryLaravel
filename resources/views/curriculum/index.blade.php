@extends('layouts.main')

@section('content')

<style>
    .grid-box {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .grid-box img {
        width: 100%;
        height: 220px;
        object-fit: contain;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #ddd;
        padding: 10px;
    }
</style>

<h2 style="text-align:center; margin:30px 0;">الخطة الدراسية والجدول</h2>

{{-- الجداول --}}
<h3>📅 الجداول الدراسية</h3>
<div class="grid-box">
    @foreach($schedules as $item)
        <img src="{{ asset('storage/' . $item->image) }}">
    @endforeach
</div>

{{-- الخطة --}}
<h3>📘 الخطة الدراسية</h3>
<div class="grid-box">
    @foreach($plans as $item)
        <img src="{{ asset('storage/' . $item->image) }}">
    @endforeach
</div>

{{-- التقويم --}}
<h3>📆 التقويم الأكاديمي</h3>
<div class="grid-box">
    @foreach($calendars as $item)
        <img src="{{ asset('storage/' . $item->image) }}">
    @endforeach
</div>

@endsection