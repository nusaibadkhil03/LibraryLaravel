@extends('layouts.main')

@section('title', 'قسم ' . $department->name)

@section('content')

<main class="main-content">

    <h2 class="dept-header">
        قسم {{ $department->name }}
    </h2>

    <section class="category-box">
        <div class="item">
            <span class="item-icon">📺</span>
            <p>قنوات تعليمية</p>
        </div>

        <div class="item active">
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

    <section class="display-screen">

        <h3 class="content-title">الكتب الرقمية</h3>

        @if(isset($books) && $books->count())
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        <div class="book-icon">📘</div>

                        <h4>{{ $book->title }}</h4>

                        @if(!empty($book->author))
                            <p>المؤلف: {{ $book->author }}</p>
                        @endif

                        @if(!empty($book->semester))
                            <p>الفصل الدراسي: {{ $book->semester }}</p>
                        @endif

                        @if(!empty($book->description))
                            <p>{{ $book->description }}</p>
                        @endif

                        @if(!empty($book->file_path))
    <a class="download-btn"
       href="{{ asset('storage/' . $book->file_path) }}"
       target="_blank">
        تحميل PDF
    </a>
  @else
    <span class="no-file">لا يوجد ملف PDF</span>
  @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-message">لا توجد كتب رقمية مضافة لهذا القسم حالياً.</p>
        @endif

    </section>

</main>

@endsection