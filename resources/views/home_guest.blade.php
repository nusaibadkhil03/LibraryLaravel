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
        <h1>مرحباً بك في مكتبة الجامعة الليبية الإلكترونية</h1>
        <p>بوابتك الرقمية الشاملة للمراجع الأكاديمية، المناهج الدراسية، وتوثيقات مشاريع التخرج.</p>

        <div class="action-buttons">
            <a href="#services" class="btn-primary">استكشف الخدمات</a>
            <a href="{{ route('guest.blocked') }}" class="btn-secondary">استعارة كتاب ورقي</a>
        </div>
    </div>
</section>

<section id="services" class="services-hub">
    <h2 class="section-title">مركز الخدمات الرقمية</h2>

    <div class="services-grid">
        <div class="service-card">
            <div class="card-icon">🏛️</div>
            <h3>الأقسام الأكاديمية</h3>
            <p>تصفح أقسام الجامعة والوصول إلى محتواها الأكاديمي.</p>
            <a href="{{ route('guest.blocked') }}" class="card-btn">الدخول إلى الأقسام</a>
        </div>

        <div class="service-card">
            <div class="card-icon">📖</div>
            <h3>المناهج والخطط الدراسية</h3>
            <p>الوصول السريع إلى المواد والمحتوى العلمي المقرر.</p>
            <a href="{{ route('guest.blocked') }}" class="card-btn">عرض المناهج</a>
        </div>

        <div class="service-card">
            <div class="card-icon">🎓</div>
            <h3>مشاريع التخرج السابقة</h3>
            <p>استلهم من أفكار وتوثيقات زملائك الخريجين.</p>
            <a href="{{ route('guest.blocked') }}" class="card-btn">استكشف المشاريع</a>
        </div>

        <div class="service-card">
            <div class="card-icon">📝</div>
            <h3>أسئلة السنوات السابقة</h3>
            <p>تدرب على نماذج الامتحانات لكل الأقسام.</p>
            <a href="{{ route('guest.blocked') }}" class="card-btn">تحميل الأسئلة</a>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('login') }}" class="btn-primary" style="margin-left: 10px;">تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="btn-secondary">إنشاء حساب</a>
    </div>
</section>
@endsection