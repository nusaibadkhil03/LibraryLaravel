@extends('layouts.main')

@section('content')

@if(session('auth_required'))
    <div id="auth-popup" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background: #fff3cd;
        color: #856404;
        padding: 14px 18px;
        border-radius: 10px;
        border: 1px solid #ffeeba;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        font-weight: bold;
    ">
        {{ session('auth_required') }}
    </div>

    <script>
        setTimeout(() => {
            const popup = document.getElementById('auth-popup');
            if (popup) popup.style.display = 'none';
        }, 3000);
    </script>
@endif

<section class="welcome-banner">
    <div class="welcome-text">
        <h1>{{ __('messages.hero_title') }}</h1>

        <p>
            {{ __('messages.hero_description_guest') }}
        </p>

        <div class="action-buttons">
            <a href="#services" class="btn-primary">
                {{ __('messages.explore_services') }}
            </a>

            <a href="{{ route('about') }}" class="btn-secondary">
                {{ __('messages.about_university') }}
            </a>
        </div>
    </div>
</section>

<section class="stats-modern-section">
    <div class="stats-header">
        <span>{{ __('messages.overview') }}</span>
        <h2>{{ __('messages.library_statistics_digital') }}</h2>
        <p>{{ __('messages.statistics_description') }}</p>
    </div>

    <div class="stats-modern-grid">

    <div class="stat-modern-card">
        <div class="stat-info">
            <span class="stat-icon">📚</span>
            <h3 class="counter" data-target="{{ $stats['library_books'] ?? $stats['books'] ?? 0 }}">
                {{ $stats['library_books'] ?? $stats['books'] ?? 0 }}
            </h3>
            <p>{{ __('messages.academic_book_reference') }}</p>
        </div>
        <div class="stat-bar">
            <span style="height:85%;"></span>
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
            <span style="height:65%;"></span>
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
        <span style="height:75%;"></span>
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
            <span style="height:45%;"></span>
        </div>
    </div>

    <div class="stat-modern-card">
        <div class="stat-info">
            <span class="stat-icon">🧾</span>
            <h3 class="counter" data-target="{{ $stats['researches'] ?? 0 }}">
                {{ $stats['researches'] ?? 0 }}
            </h3>
            <p>{{ __('messages.research_or_journal') }}</p>
        </div>
        <div class="stat-bar">
            <span style="height:55%;"></span>
        </div>
    </div>

</div>
</section>

<section class="academic-showcase" id="services">
    <div class="showcase-header">
        <span>{{ __('messages.featured_content') }}</span>
        <h2>{{ __('messages.quick_window') }}</h2>
        <p>{{ __('messages.guest_quick_description') }}</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card guest-info-card">
            <h3>{{ __('messages.digital_books') }}</h3>

            <div class="locked-preview-item">
                <div class="mini-icon">📚</div>
                <div>
                    <strong>{{ __('messages.academic_books_references') }}</strong>
                    <p>{{ __('messages.digital_books_description') }}</p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">🔒</div>
                <div>
                    <strong>{{ __('messages.login_required') }}</strong>
                    <p>{{ __('messages.login_required_books') }}</p>
                </div>
            </div>

            <a href="{{ route('guest.blocked') }}" class="showcase-btn guest-popup-btn">
                {{ __('messages.browse_books') }}
            </a>
        </div>

        <div class="showcase-card journal-feature"
             style="background-image: url('{{ asset('images/journals-bg.jpeg') }}');">
            <div class="journal-overlay">
                

                <h3>{{ __('messages.university_journals') }}</h3>
                <p>{{ __('messages.university_journals_description') }}</p>

                <a href="{{ route('journals') }}" class="journal-btn">
                    {{ __('messages.browse_journals') }}
                </a>
            </div>
        </div>

        <div class="showcase-card updates-card guest-info-card">
            <h3>{{ __('messages.about_university') }}</h3>

            <div class="locked-preview-item">
                <div class="mini-icon">🏛️</div>
                <div>
                    <strong>{{ __('messages.general_info') }}</strong>
                    <p>{{ __('messages.university_info_description') }}</p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">✅</div>
                <div>
                    <strong>{{ __('messages.available_for_guest') }}</strong>
                    <p>{{ __('messages.guest_about_description') }}</p>
                </div>
            </div>

            <a href="{{ route('about') }}" class="showcase-btn">
                {{ __('messages.open_about_page') }}
            </a>
        </div>

    </div>
</section>

<div style="margin:35px 0; text-align:center;">
    <a href="{{ route('login') }}" class="btn-primary" style="margin-left:10px;">
        {{ __('messages.login') }}
    </a>

    <a href="{{ route('register') }}" class="btn-secondary">
        {{ __('messages.register') }}
    </a>
</div>

@endsection