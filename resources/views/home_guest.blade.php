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

<section class="stats-modern-section">
    <div class="stats-header">
        <span>نظرة عامة</span>
        <h2>إحصائيات المكتبة الرقمية</h2>
        <p>أرقام مباشرة من قاعدة البيانات تعكس محتوى المنصة وخدماتها الأكاديمية.</p>
    </div>

    <div class="stats-modern-grid">
        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📚</span>
                <h3 class="counter" data-target="{{ $stats['books'] ?? 0 }}">{{ $stats['books'] ?? 0 }}</h3>
                <p>كتاب ومرجع أكاديمي</p>
            </div>
            <div class="stat-bar"><span style="height: 85%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🎓</span>
                <h3 class="counter" data-target="{{ $stats['projects'] ?? 0 }}">{{ $stats['projects'] ?? 0 }}</h3>
                <p>مشروع تخرج</p>
            </div>
            <div class="stat-bar"><span style="height: 65%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🏛️</span>
                <h3 class="counter" data-target="{{ $stats['departments'] ?? 0 }}">{{ $stats['departments'] ?? 0 }}</h3>
                <p>قسم أكاديمي</p>
            </div>
            <div class="stat-bar"><span style="height: 45%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🧾</span>
                <h3 class="counter" data-target="{{ $stats['researches'] ?? 0 }}">{{ $stats['researches'] ?? 0 }}</h3>
                <p>بحث أو مجلة علمية</p>
            </div>
            <div class="stat-bar"><span style="height: 55%;"></span></div>
        </div>
    </div>
</section>

<section class="academic-showcase">
    <div class="showcase-header">
        <span>محتوى مميز</span>
        <h2>نافذة سريعة على المكتبة الرقمية</h2>
        <p>تعرف على أهم محتويات المنصة، وللوصول الكامل يرجى تسجيل الدخول.</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card guest-info-card">
            <h3>الكتب الرقمية</h3>

            <div class="locked-preview-item">
                <div class="mini-icon">📚</div>
                <div>
                    <strong>تعرف على آخر الكتب المضافة</strong>
                    <p>كتب ومراجع رقمية يتم تنظيمها حسب الأقسام الأكاديمية.</p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">⬇️</div>
                <div>
                    <strong>الأكثر تحميلًا</strong>
                    <p>اكتشف الكتب الأكثر استخدامًا داخل المنصة بعد تسجيل الدخول.</p>
                </div>
            </div>

            <a href="{{ route('guest.blocked') }}" class="showcase-btn guest-popup-btn">
                استعراض الكتب
            </a>
        </div>

        <div class="showcase-card journal-feature"
             style="background-image: url('{{ asset('images/journals-bg.jpeg') }}');">
            <div class="journal-overlay">
                <h3>مجلات الجامعة</h3>
                <p>تصفح الإصدارات العلمية والمجلات الأكاديمية الخاصة بالجامعة.</p>

                <a href="{{ route('guest.blocked') }}" class="journal-btn guest-popup-btn">
                    استعراض المجلات
                </a>
            </div>
        </div>

        <div class="showcase-card updates-card guest-info-card">
            <h3>آخر الإضافات الأكاديمية</h3>

            <div class="locked-preview-item">
                <div class="mini-icon">🆕</div>
                <div>
                    <strong>محتوى جديد باستمرار</strong>
                    <p>تحديثات مستمرة للكتب، المشاريع، الأسئلة، والمجلات.</p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">🎓</div>
                <div>
                    <strong>مواد تخدم الطالب</strong>
                    <p>كل إضافة تهدف لتسهيل الوصول للمحتوى الأكاديمي.</p>
                </div>
            </div>

            <a href="{{ route('guest.blocked') }}" class="showcase-btn guest-popup-btn">
                استكشف الإضافات
            </a>
        </div>

    </div>
</section>
<div style="margin: 35px 0; text-align: center;">
    <a href="{{ route('login') }}" class="btn-primary" style="margin-left: 10px;">تسجيل الدخول</a>
    <a href="{{ route('register') }}" class="btn-secondary">إنشاء حساب</a>
</div>

@endsection