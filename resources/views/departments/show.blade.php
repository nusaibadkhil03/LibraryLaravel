@extends('layouts.app')

@section('title', 'قسم الحاسب الآلي')

@section('content')

<main class="main-content">

    <h2 class="dept-header">
    {{ $data['icon'] }} قسم {{ $data['name'] }}
    </h2>
    <!-- الأيقونات -->
    <section class="category-box">

        <div class="item">
            <span class="item-icon">📺</span>
            <p>قنوات تعليمية</p>
        </div>

        <div class="item">
            <span class="item-icon">📚</span>
            <p>الكتب</p>
        </div>

        <div class="item">
            <span class="item-icon">📖</span>
            <p>المناهج</p>
        </div>

        <div class="item">
            <span class="item-icon">📝</span>
            <p>أسئلة سنوات سابقة</p>
        </div>

        <div class="item">
            <span class="item-icon">🎓</span>
            <p>مشاريع تخرج</p>
        </div>

    </section>

    <!-- عرض المحتوى -->
    <section class="display-screen">
        هنا يتم عرض محتوى القسم
    </section>

</main>

@endsection