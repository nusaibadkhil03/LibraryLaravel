@extends('layouts.main')

@section('content')

<section class="services-hub">
    <h2 class="section-title">مجلات الجامعة</h2>

    <div class="services-grid">
        @forelse($journals as $journal)
            <div class="service-card">
                <div class="card-icon">📰</div>

                <h3>{{ $journal->title ?? 'عنوان غير متوفر' }}</h3>

                <p>
                    {{ Str::limit($journal->description ?? 'مجلة أو بحث علمي منشور ضمن محتوى الجامعة.', 120) }}
                </p>

                @if(!empty($journal->file))
                    <a href="{{ asset('storage/' . $journal->file) }}" class="card-btn" target="_blank">
                        عرض المجلة
                    </a>
                @else
                    <span class="card-btn">لا يوجد ملف</span>
                @endif
            </div>
        @empty
            <div class="service-card">
                <h3>لا توجد مجلات حالياً</h3>
                <p>سيتم عرض المجلات عند إضافتها من لوحة التحكم.</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 30px;">
        {{ $journals->links() }}
    </div>
</section>

@endsection