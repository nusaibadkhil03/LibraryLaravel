<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الجامعة الليبية</title>
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
</style>
</head>
<body>

<header class="site-header">
    <div class="header-wrapper">

        <div class="header-top-row">

         <div class="header-logo-search">
    <img src="{{ asset('images/logo.png') }}" alt="شعار المكتبة" class="logo-img">

    <div class="search-container">
        <input
            type="text"
            id="liveSearchInput"
            name="q"
            placeholder="ابحث عن كتاب، منهج، أو مشروع..."
            autocomplete="off"
        >

        <button type="button" class="search-icon">🔍</button>

        <div id="liveSearchResults" class="live-search-results"></div>
    </div>
</div>
            {{-- الوسط: العنوان --}}
            <div class="header-title">
                <h2>مكتبة الجامعة الليبية</h2>
                <p>منصة الكتب الأكاديمية</p>
            </div>

            {{-- يسار: الأزرار --}}
            <div class="header-actions">
                <button class="btn-white">EN/AR</button>

                @auth
                    <a href="{{ route('profile.edit') }}" class="btn-white">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn-white">Sign up</a>
                    <a href="{{ route('login') }}" class="btn-white">👤</a>
                @endauth
            </div>

        </div>

        <nav class="main-menu">
            <ul>
                <li><a href="{{ url('/') }}">الرئيسية</a></li>

                <li class="dropdown">
    @auth
        <a href="#" class="dropbtn">الأقسام ▼</a>
        <div class="dropdown-content">
            @isset($departments)
                @foreach($departments as $department)
                    <a href="{{ route('departments.show', $department->slug) }}">
                        {{ $department->name }}
                    </a>
                @endforeach
            @endisset
        </div>
    @else
        <a href="#" class="dropbtn guest-popup-btn">الأقسام ▼</a>
        <div class="dropdown-content">
            @isset($departments)
                @foreach($departments as $department)
                    <a href="#" class="guest-popup-btn">{{ $department->name }}</a>
                @endforeach
            @endisset
        </div>
    @endauth
</li>

                <li>
                    @auth
                        <a href="{{ route('curriculum') }}">الخطة الدراسية</a>
                    @else
                        <a href="#" class="guest-popup-btn">الخطة الدراسية</a>
                    @endauth
                </li>

                <li>
                    @auth
                        <a href="{{ route('borrow') }}">استعارة كتاب</a>
                    @else
                        <a href="#" class="guest-popup-btn">استعارة كتاب</a>
                    @endauth
                </li>
            </ul>
        </nav>

    </div>
</header>

<main class="container">
    @yield('content')
</main>

<footer class="main-footer">
    <div class="footer-container">

        <div class="footer-section footer-about">
            <h3>مكتبة الجامعة الليبية</h3>
            <p>
                منصة أكاديمية رقمية تهدف إلى تنظيم المحتوى العلمي وتسهيل وصول الطلاب إلى الكتب، المناهج، المجلات، والمشاريع الجامعية.
            </p>
        </div>

        <div class="footer-section">
            <h3>روابط سريعة</h3>
            <ul>
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li><a href="{{ route('about') }}">عن الجامعة</a></li>
                <li><a href="{{ route('journals') }}">المجلات</a></li>

                @auth
                    <li><a href="{{ route('curriculum') }}">الخطة الدراسية</a></li>
                    <li><a href="{{ route('borrow') }}">استعارة كتاب</a></li>
                    <li><a href="#services">الخدمات</a></li>
                @else
                    <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                    <li><a href="{{ route('register') }}">إنشاء حساب</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-section">
            <h3>خدمات المنصة</h3>
            <ul>
                @auth
                    <li><a href="{{ route('curriculum') }}">المناهج والخطة الدراسية</a></li>
                    <li><a href="{{ route('borrow') }}">طلبات الاستعارة</a></li>
                    <li><a href="{{ route('journals') }}">المجلات العلمية</a></li>
                @else
                    <li><a href="{{ route('guest.blocked') }}">الكتب الرقمية</a></li>
                    <li><a href="{{ route('guest.blocked') }}">المناهج الدراسية</a></li>
                    <li><a href="{{ route('journals') }}">المجلات العلمية</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-section footer-contact">
    <h3>تواصل معنا</h3>

    <p>
        📍
        <a href="https://maps.apple.com/place?coordinate=32.90753410%2C13.18115658"
           target="_blank">
            موقع الجامعة على الخريطة
        </a>
    </p>

    <p>
        🌐
        <a href="https://libyanuniv.edu.ly"
           target="_blank">
            الموقع الرسمي للجامعة الليبية
        </a>
    </p>

    

    <p>🕘 السبت - الخميس</p>

    <p>⏰ 08:00 صباحًا - 05:00 عصرًا</p>
</div>

    </div>

    <div class="footer-bottom">
        <p>
            © {{ date('Y') }} مكتبة الجامعة الليبية - جميع الحقوق محفوظة
        </p>
    </div>
</footer>
@guest
<div id="authModal" class="auth-modal">
    <div class="auth-modal-box">
        <button class="auth-close-btn" id="closeAuthModal">&times;</button>

        <div class="auth-modal-icon">🔒</div>
        <h2>يجب تسجيل الدخول أولاً</h2>
        <p>للوصول إلى الأقسام والخدمات الأكاديمية، يرجى تسجيل الدخول أو إنشاء حساب جديد.</p>

        <div class="auth-modal-actions">
            <a href="{{ route('login') }}" class="auth-btn primary">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="auth-btn secondary">إنشاء حساب</a>
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
document.addEventListener('DOMContentLoaded', function () {
    console.log('live search loaded');

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
                    : '<div class="live-search-empty">لا توجد نتائج</div>';

                box.style.display = 'block';
            });
    });
});
</script>
</body>
</html>