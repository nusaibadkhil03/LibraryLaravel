@extends('layouts.main')

@section('content')

<section class="welcome-banner">
    <div class="welcome-text">
<h1>{{ __('messages.hero_title') }}</h1>
<p>{{ __('messages.hero_description') }}</p>
        <div class="action-buttons">
             <a href="{{ route('about') }}" class="btn-primary">{{ __('messages.about_university') }}</a>
             <a href="{{ route('borrow') }}" class="btn-secondary">{{ __('messages.borrow_paper_book') }}</a>        </div>
    </div>
</section>

<section class="stats-modern-section">
    <div class="stats-header">
        <span>{{ __('messages.overview') }}</span>
        <h2>{{ __('messages.library_statistics') }}</h2>
        <p>{{ __('messages.statistics_description') }}</p>
    </div>

    <div class="stats-modern-grid">

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📚</span>
                <h3 class="counter" data-target="{{ $stats['library_books'] ?? 0 }}">
                    {{ $stats['library_books'] ?? 0 }}
                </h3>
        <p>{{ __('messages.book') }}</p>
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
                <p>{{ __('messages.graduation_project') }}</p>
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
                <p>{{ __('messages.syllabus') }}</p>
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
        <p>{{ __('messages.academic_department') }}</p>
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
                <p>{{ __('messages.scientific_research') }}</p>
            </div>
            <div class="stat-bar">
                <span style="height: 55%;"></span>
            </div>
        </div>

    </div>
</section>

<section class="academic-showcase">
    <div class="showcase-header">
        
        <h2>{{ __('messages.quick_window') }}</h2>
        <p>{{ __('messages.quick_window_description') }}</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card">
    <h3>{{ __('messages.most_downloaded_books') }}</h3>

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
                
                <h3>{{ __('messages.university_journals') }}</h3>
                <p>{{ __('messages.university_journals_description') }}</p>
                <a href="{{ route('journals') }}" class="journal-btn">{{ __('messages.browse_journals') }}</a>
            </div>
        </div>

        <div class="showcase-card updates-card">
    <h3>{{ __('messages.latest_academic_additions') }}</h3>

    @if(isset($latestBooks) && $latestBooks->count())
        <a href="{{ asset('storage/' . $latestBooks->first()->file_path) }}"
           target="_blank"
           class="update-item mini-link">
            <span>📚</span>
            <div>
                <strong>{{ __('messages.new_book') }}</strong>
                <p>{{ $latestBooks->first()->title ?? __('messages.new_book_added') }}</p>
            </div>
        </a>
    @endif

    @if(isset($latestProjects) && $latestProjects->count())
        <a href="{{ route('projects') }}"
           class="update-item mini-link">
            <span>🎓</span>
            <div>
                <strong>{{ __('messages.graduation_project') }}</strong>
                <p>{{ $latestProjects->first()->title ?? __('messages.new_project_added') }}</p>
            </div>
        </a>
    @endif

    @if(isset($latestJournals) && $latestJournals->count())
        <a href="{{ route('journals') }}"
           class="update-item mini-link">
            <span>🧾</span>
            <div>
                <strong>{{ __('messages.research_or_journal') }}</strong>
                <p>{{ $latestJournals->first()->title ?? 'تمت إضافة إصدار جديد' }}</p>
            </div>
        </a>
    @endif
</div>
</section>

@endsection