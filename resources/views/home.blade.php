@extends('layouts.main')

@section('content')

<section class="welcome-banner">
    <div class="welcome-text">
        <h1>مرحباً بك في مكتبة الجامعة الليبية الإلكترونية</h1>
        <p>بوابتك الرقمية الشاملة للمراجع الأكاديمية، المناهج الدراسية، وتوثيقات مشاريع التخرج.</p>

        <div class="action-buttons">
            <a href="{{ route('about') }}" class="btn-primary">عن الجامعة</a>
            <a href="{{ route('borrow') }}" class="btn-secondary">استعارة كتاب ورقي</a>
        </div>
    </div>
</section>

<section class="stats-modern-section">
    <div class="stats-header">
        <span>نظرة عامة</span>
        <h2>إحصائيات المكتبة </h2>
        <p>أرقام مباشرة من قاعدة البيانات تعكس محتوى المنصة وخدماتها الأكاديمية.</p>
    </div>

    <div class="stats-modern-grid">

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📚</span>
                <h3 class="counter" data-target="{{ $stats['library_books'] ?? 0 }}">
                    {{ $stats['library_books'] ?? 0 }}
                </h3>
                <p>كتاب </p>
            </div>
            <div class="stat-bar">
                <span style="height: 85%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🎓</span>
                <h3 class="counter" data-target="{{ $stats['projects'] ?? 0 }}">
                    {{ $stats['projects'] ?? 0 }}
                </h3>
                <p>مشروع تخرج</p>
            </div>
            <div class="stat-bar">
                <span style="height: 65%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📖</span>
                <h3 class="counter" data-target="{{ $stats['syllabuses'] ?? 0 }}">
                    {{ $stats['syllabuses'] ?? 0 }}
                </h3>
                <p>منهج دراسي</p>
            </div>
            <div class="stat-bar">
                <span style="height: 75%;"></span>
            </div>
        </div>
         <div class="stat-modern-card">
    <div class="stat-info">
        <span class="stat-icon">🏛️</span>
        <h3 class="counter" data-target="{{ $stats['departments'] ?? 0 }}">
            {{ $stats['departments'] ?? 0 }}
        </h3>
        <p>قسم أكاديمي</p>
    </div>
    <div class="stat-bar">
        <span style="height: 55%;"></span>
    </div>
</div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🔬</span>
                <h3 class="counter" data-target="{{ $stats['researches'] ?? 0 }}">
                    {{ $stats['researches'] ?? 0 }}
                </h3>
                <p>بحث علمي</p>
            </div>
            <div class="stat-bar">
                <span style="height: 55%;"></span>
            </div>
        </div>

    </div>
</section>

<section class="academic-showcase">
    <div class="showcase-header">
        
        <h2>نافذة سريعة على المكتبة الرقمية</h2>
        <p>وصول سريع لأهم المحتويات الأكاديمية المضافة داخل المنصة.</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card">
    <h3>أكثر الكتب الرقمية تحميلًا</h3>

    @forelse(($mostDownloadedBooks ?? collect())->take(3) as $book)
        <a href="{{ asset('storage/' . $book->file_path) }}"
           target="_blank"
           class="mini-book mini-link">
            <div class="mini-icon">📘</div>
            <div>
                <strong>{{ $book->title ?? 'عنوان غير متوفر' }}</strong>
                <p>{{ $book->downloads_count ?? 0 }} تحميل</p>
            </div>
        </a>
    @empty
        <p class="empty-text">لا توجد بيانات تحميل حالياً.</p>
    @endforelse
</div>

        <div class="showcase-card journal-feature"
             style="background-image: url('{{ asset('images/journals-bg.jpeg') }}');">
            <div class="journal-overlay">
                
                <h3>مجلات الجامعة</h3>
                <p>تصفح الإصدارات العلمية والمجلات الأكاديمية الخاصة بالجامعة.</p>
                <a href="{{ route('journals') }}" class="journal-btn">استعراض المجلات</a>
            </div>
        </div>

        <div class="showcase-card updates-card">
    <h3>آخر الإضافات الأكاديمية</h3>

    @if(isset($latestBooks) && $latestBooks->count())
        <a href="{{ asset('storage/' . $latestBooks->first()->file_path) }}"
           target="_blank"
           class="update-item mini-link">
            <span>📚</span>
            <div>
                <strong>كتاب جديد</strong>
                <p>{{ $latestBooks->first()->title ?? 'تمت إضافة كتاب جديد' }}</p>
            </div>
        </a>
    @endif

    @if(isset($latestProjects) && $latestProjects->count())
        <a href="{{ route('projects') }}"
           class="update-item mini-link">
            <span>🎓</span>
            <div>
                <strong>مشروع تخرج</strong>
                <p>{{ $latestProjects->first()->title ?? 'تمت إضافة مشروع جديد' }}</p>
            </div>
        </a>
    @endif

    @if(isset($latestJournals) && $latestJournals->count())
        <a href="{{ route('journals') }}"
           class="update-item mini-link">
            <span>🧾</span>
            <div>
                <strong>بحث أو مجلة</strong>
                <p>{{ $latestJournals->first()->title ?? 'تمت إضافة إصدار جديد' }}</p>
            </div>
        </a>
    @endif
</div>
</section>

@endsection