@extends('layouts.main')

@section('content')
<section class="welcome-banner">
    <div class="welcome-text">
        <h1>مرحباً بك في مكتبة الجامعة الليبية الإلكترونية</h1>
        <p>بوابتك الرقمية الشاملة للمراجع الأكاديمية، المناهج الدراسية، وتوثيقات مشاريع التخرج.</p>
        <div class="action-buttons">
            <a href="#services" class="btn-primary">استكشف الخدمات</a>
            <a href="{{ url('/borrow') }}" class="btn-secondary">استعارة كتاب ورقي</a>
        </div>
    </div>
</section>

<section id="services" class="services-hub">
    <h2 class="section-title">مركز الخدمات الرقمية</h2>

    <div class="services-grid">
        <div class="service-card">
            <div class="card-icon">📚</div>
            <h3>الكتب الإلكترونية (PDF)</h3>
            <p>تصفح وتحميل مئات المراجع الأكاديمية.</p>
            <a href="{{ url('/books') }}" class="card-btn">تصفح الكتب</a>
        </div>

        <div class="service-card">
            <div class="card-icon">📖</div>
            <h3>المناهج والخطط الدراسية</h3>
            <p>الوصول السريع إلى المواد والمحتوى العلمي المقرر.</p>
            <a href="{{ url('/curriculum') }}" class="card-btn">عرض المناهج</a>
        </div>

        <div class="service-card">
            <div class="card-icon">🎓</div>
            <h3>مشاريع التخرج السابقة</h3>
            <p>استلهم من أفكار وتوثيقات زملائك الخريجين.</p>
            <a href="{{ url('/projects') }}" class="card-btn">استكشف المشاريع</a>
        </div>

        <div class="service-card">
            <div class="card-icon">📝</div>
            <h3>أسئلة السنوات السابقة</h3>
            <p>تدرب على نماذج الامتحانات لكل الأقسام.</p>
            <a href="{{ url('/exams') }}" class="card-btn">تحميل الأسئلة</a>
        </div>
    </div>
</section>
@endsection