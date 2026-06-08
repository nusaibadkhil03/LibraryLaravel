<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.library_name'))</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .header-container {
            max-width: 1200px !important;
            margin: 0 auto !important;
            display: grid !important;
            grid-template-columns: auto 1fr auto !important;
            align-items: center !important;
            padding: 0px !important;
        }

        .favorite-btn {
            border: none;
            background: #fff7ed;
            color: #f97316;
            padding: 10px 13px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 17px;
            margin-left: 8px;
            transition: 0.3s;
        }

        .favorite-btn:hover {
            background: #ffedd5;
            transform: translateY(-2px);
        }

        .success-toast {
            position: fixed;
            top: 25px;
            left: 25px;
            z-index: 9999;
            background: #16a34a;
            color: white;
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: slideIn 0.4s ease;
        }

        html[dir="rtl"] .success-toast {
            left: 25px;
            right: auto;
        }

        html[dir="ltr"] .success-toast {
            right: 25px;
            left: auto;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-row {
            width: 260px;
            min-height: auto !important;
            padding: 18px;
            border-radius: 16px;
            background: #fff;
        }

        .content-info {
            width: 100%;
        }

        .content-main-title {
            display: block;
            font-size: 17px;
            margin-bottom: 12px;
            color: #222;
        }

        .content-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .content-meta span {
            background: #fff7ed;
            color: #555;
            border: 1px solid #fed7aa;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .content-description {
            font-size: 13px;
            color: #666;
            line-height: 1.7;
            margin: 8px 0 12px;
        }

        .content-action {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
        }

        .download-btn {
            flex: 1;
            text-align: center;
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="header-wrapper">

        <div class="header-top-row">

            <div class="header-logo-search">
                <img src="{{ asset('images/logo.png') }}"
                     alt="{{ __('messages.logo_alt') }}"
                     class="logo-img">

                <div class="search-container">
                    <input
                        type="text"
                        id="liveSearchInput"
                        name="q"
                        placeholder="{{ __('messages.search_placeholder') }}"
                        autocomplete="off"
                    >

                    <button type="button" class="search-icon">🔍</button>

                    <div id="liveSearchResults" class="live-search-results"></div>
                </div>
            </div>

            <div class="header-title">
                <h2>{{ __('messages.library_name') }}</h2>
                <p>{{ __('messages.platform_name') }}</p>
            </div>

            <div class="header-actions">
                @if(app()->getLocale() == 'ar')
                    <a href="{{ route('language.switch', 'en') }}" class="btn-white">EN</a>
                @else
                    <a href="{{ route('language.switch', 'ar') }}" class="btn-white">AR</a>
                @endif

                @auth
                    <a href="{{ route('profile.edit') }}" class="btn-white">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-white">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn-white">
                        {{ __('messages.register') }}
                    </a>

                    <a href="{{ route('login') }}" class="btn-white" title="{{ __('messages.login') }}">
                        👤
                    </a>
                @endauth
            </div>

        </div>

        <nav class="main-menu">
            <ul>

                <li>
                    <a href="{{ url('/') }}">
                        {{ __('messages.home') }}
                    </a>
                </li>

                <li class="dropdown">
                    @auth
                        <a href="#" class="dropbtn">
                            {{ __('messages.departments') }} ▼
                        </a>

                        <div class="dropdown-content">
    @isset($departments)
        @foreach($departments as $department)
            <a href="{{ route('departments.show', $department->slug) }}">
                {{ app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name }}
            </a>
        @endforeach
    @endisset
</div>
                    @else
                        <a href="#" class="dropbtn guest-popup-btn">
                            {{ __('messages.departments') }} ▼
                        </a>

<div class="dropdown-content">
    @isset($departments)
        @foreach($departments as $department)
            <a href="#" class="guest-popup-btn">
                {{ app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name }}
            </a>
        @endforeach
    @endisset
</div>                    @endauth
                </li>

                <li>
                    @auth
                        <a href="{{ route('curriculum') }}">
                            {{ __('messages.curriculum') }}
                        </a>
                    @else
                        <a href="#" class="guest-popup-btn">
                            {{ __('messages.curriculum') }}
                        </a>
                    @endauth
                </li>

                <li>
                    @auth
                        <a href="{{ route('borrow') }}">
                            {{ __('messages.borrow_book') }}
                        </a>
                    @else
                        <a href="#" class="guest-popup-btn">
                            {{ __('messages.borrow_book') }}
                        </a>
                    @endauth
                </li>

                <li>
                    @auth
                        <a href="{{ route('favorites.index') }}"
                           title="{{ __('messages.favorites') }}">
                            ⭐
                        </a>
                    @else
                        <a href="#"
                           class="guest-popup-btn"
                           title="{{ __('messages.favorites') }}">
                            ⭐
                        </a>
                    @endauth
                </li>

            </ul>
        </nav>

    </div>
</header>

@if(session('success'))
    <div id="success-message" class="success-toast">
        {{ session('success') }}
    </div>
@endif

<main class="container">
    @yield('content')
</main>

<footer class="main-footer">
    <div class="footer-container">

        <div class="footer-section footer-about">
            <h3>{{ __('messages.library_name') }}</h3>
            <p>
                {{ __('messages.footer_about') }}
            </p>
        </div>

        <div class="footer-section">
            <h3>{{ __('messages.quick_links') }}</h3>
            <ul>
                <li><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('about') }}">{{ __('messages.about_university') }}</a></li>
                <li><a href="{{ route('journals') }}">{{ __('messages.journals') }}</a></li>

                @auth
                    <li><a href="{{ route('curriculum') }}">{{ __('messages.curriculum') }}</a></li>
                    <li><a href="{{ route('borrow') }}">{{ __('messages.borrow_book') }}</a></li>
                    <li><a href="#services">{{ __('messages.services') }}</a></li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-section">
            <h3>{{ __('messages.platform_services') }}</h3>
            <ul>
                @auth
                    <li><a href="{{ route('curriculum') }}">{{ __('messages.curriculum_and_plans') }}</a></li>
                    <li><a href="{{ route('borrow') }}">{{ __('messages.borrow_requests') }}</a></li>
                    <li><a href="{{ route('journals') }}">{{ __('messages.scientific_journals') }}</a></li>
                @else
                    <li><a href="{{ route('guest.blocked') }}">{{ __('messages.digital_books') }}</a></li>
                    <li><a href="{{ route('guest.blocked') }}">{{ __('messages.curriculum') }}</a></li>
                    <li><a href="{{ route('journals') }}">{{ __('messages.scientific_journals') }}</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-section footer-contact">
            <h3>{{ __('messages.contact_us') }}</h3>

            <p>
                📍
                <a href="https://maps.apple.com/place?coordinate=32.90753410%2C13.18115658"
                   target="_blank">
                    {{ __('messages.university_location') }}
                </a>
            </p>

            <p>
                🌐
                <a href="https://libyanuniv.edu.ly"
                   target="_blank">
                    {{ __('messages.official_website') }}
                </a>
            </p>

            <p>🕘 {{ __('messages.work_days') }}</p>

            <p>⏰ {{ __('messages.work_hours') }}</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>
            © {{ date('Y') }} {{ __('messages.copyright') }}
        </p>
    </div>
</footer>

@guest
<div id="authModal" class="auth-modal">
    <div class="auth-modal-box">
        <button class="auth-close-btn" id="closeAuthModal">&times;</button>

        <div class="auth-modal-icon">🔒</div>
        <h2>{{ __('messages.login_required_title') }}</h2>
        <p>{{ __('messages.login_required_text') }}</p>

        <div class="auth-modal-actions">
            <a href="{{ route('login') }}" class="auth-btn primary">
                {{ __('messages.login') }}
            </a>

            <a href="{{ route('register') }}" class="auth-btn secondary">
                {{ __('messages.register') }}
            </a>
        </div>
    </div>
</div>
@endguest

@guest
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('authModal');
    const openButtons = document.querySelectorAll('.guest-popup-btn');
    const closeButton = document.getElementById('closeAuthModal');

    openButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.add('show');
        });
    });

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    }
});
</script>
@endguest

<script>
setTimeout(() => {
    const message = document.getElementById('success-message');

    if(message){
        message.style.transition = '0.5s';
        message.style.opacity = '0';

        setTimeout(() => {
            message.remove();
        }, 500);
    }
}, 2500);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('liveSearchInput');
    const box = document.getElementById('liveSearchResults');

    if (!input || !box) return;

    input.addEventListener('input', function () {
        const q = this.value.trim();

        if (q.length < 2) {
            box.innerHTML = '';
            box.style.display = 'none';
            return;
        }

        fetch(`/live-search?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                box.innerHTML = data.length
                    ? data.map(item => `
                        <a href="${item.url}" class="live-search-item">
                            <span>${item.title}</span>
                            <small>${item.type}</small>
                        </a>
                    `).join('')
                    : `<div class="live-search-empty">${@json(__('messages.no_results'))}</div>`;

                box.style.display = 'block';
            });
    });
});
</script>

</body>
</html>
