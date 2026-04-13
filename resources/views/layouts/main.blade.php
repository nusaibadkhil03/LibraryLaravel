<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الجامعة الليبية</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <div class="header-container">

        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}" alt="شعار المكتبة" class="logo-img">

            <div class="search-container">
                <input type="text" placeholder="ابحث عن كتاب، منهج، أو مشروع...">
                <span class="search-icon">🔍</span>
            </div>
        </div>

        <div class="header-center">
            <h2 class="site-title">مكتبة الجامعة الليبية</h2>
            <p class="site-subtitle">منصة الكتب الأكاديمية</p>
        </div>

        <div class="header-right">
           <div class="auth-nav">
    <button class="btn-white">EN/AR</button>

     @auth
        <a href="{{ route('profile.edit') }}" class="btn-white">
            {{ Auth::user()->name }}
        </a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn-white">Logout</button>
        </form>
     @else
        <a href="{{ route('register') }}" class="btn-white">Sign up</a>
        <a href="{{ route('login') }}" class="btn-white">👤</a>
     @endauth
     </div>
        </div>
    </div>

    <nav class="main-menu">
        <ul>
            <li><a href="{{ url('/') }}">الرئيسية</a></li>

            <li class="dropdown">
                <a href="#" class="dropbtn">الأقسام ▼</a>
                <div class="dropdown-content">
                    <a href="{{ url('/departments/cs') }}">الحاسب الآلي</a>
                    <a href="{{ url('/departments/accounting') }}">المحاسبة</a>
                    <a href="{{ url('/departments/law') }}">القانون</a>
                    <a href="{{ url('/departments/business') }}">إدارة الأعمال</a>
                    <a href="{{ url('/departments/petroleum') }}">هندسة النفط</a>
                    <a href="{{ url('/departments/arch') }}">الهندسة المعمارية</a>
                </div>
            </li>

            <li><a href="{{ route('curriculum') }}">الخطة الدراسية</a></li>
            <li><a href="{{ url('/borrow') }}">استعارة كتاب</a></li>
        </ul>
    </nav>
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
                <li><a href="{{ url('/books') }}">الكتب</a></li>
                <li><a href="{{ route('curriculum') }}">الخطة الدراسية</a></li>
                <li><a href="#services">الخدمات</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>تواصل</h3>
            <p>عين زارة - طرابلس</p>
            <p>رقم الهاتف: 09XXXXXXXX</p>
            <p>البريد الإلكتروني: info@university.ly</p>
        </div>
    </div>
</footer>

</body>
</html>