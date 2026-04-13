@extends('layouts.app')

@section('title', 'الخطة الدراسية')

@section('content')

<main class="main-content">

    <h1 class="page-title">الخطة الدراسية والجداول</h1>

    <section class="category-box">

        <div class="item">
            <span style="font-size:40px;">📅</span>
            <p>الجداول الدراسية</p>
        </div>

        <div class="item">
            <span style="font-size:40px;">📘</span>
            <p>الخطط الفصلية</p>
        </div>

        <div class="item">
            <span style="font-size:40px;">🗓️</span>
            <p>التقويم الأكاديمي</p>
        </div>

    </section>

    <div class="plans-grid">

        <div class="plan-card">
            <h3>جدول الفصل الدراسي الحالي</h3>
            <a href="{{ asset('images/current_schedule.png') }}" download class="btn-download">
                تحميل الصورة
            </a>
        </div>

        <div class="plan-card">
            <h3>الخطة الدراسية (3 أشهر)</h3>
            <a href="{{ asset('images/study_plan.png') }}" download class="btn-download">
                تحميل الصورة
            </a>
        </div>

        <div class="plan-card">
            <h3>التقويم الأكاديمي العام</h3>
            <a href="{{ asset('images/academic_calendar.png') }}" download class="btn-download">
                تحميل الصورة
            </a>
        </div>

    </div>

</main>

@endsection