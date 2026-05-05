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
    padding: 20px !important;
}
</style>
</head>
<body>

<header class="site-header">
    <div class="header-wrapper">

        <div class="header-top-row">

           <div class="header-logo-search">
    <img src="{{ asset('images/logo.png') }}" alt="شعار المكتبة" class="logo-img">

    <form action="{{ route('search') }}" method="GET" class="search-container">
        <input
            type="text"
            name="q"
            placeholder="ابحث عن كتاب، منهج، أو مشروع..."
            value="{{ request('q') }}"
        >
        <button type="submit" class="search-icon">🔍</button>
    </form>
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
                            @foreach($departments as $department)
                                <a href="{{ route('departments.show', $department->slug) }}">
                                    {{ $department->name }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <a href="#" class="dropbtn guest-popup-btn">الأقسام ▼</a>
                        <div class="dropdown-content">
                            @foreach($departments as $department)
                                <a href="#" class="guest-popup-btn">{{ $department->name }}</a>
                            @endforeach
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

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>روابط سريعة</h3>
            <ul>
                <li><a href="{{ url('/') }}">الرئيسية</a></li>
                <li><a href="#">الأقسام</a></li>
                <li><a href="{{ route('curriculum') }}">الخطة الدراسية</a></li>
                <li><a href="{{ route('borrow') }}">استعارة كتاب</a></li>
                <li><a href="#services">الخدمات</a></li>
            </ul>
        </div>
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

</body>
</html>