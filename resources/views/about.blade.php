@extends('layouts.main')

@section('content')

<section class="about-cinematic">

    <div class="about-slide active"
         style="background-image: url('{{ asset('images/campus.jpeg') }}');"
         data-title="الجامعة الليبية للعلوم الإنسانية والتطبيقية"
         data-text="جامعة حاصلة على إذن مزاولة من وزارة التعليم العالي والبحث العلمي، ومعتمدة من المركز الوطني لضمان الجودة.">
    </div>

    <div class="about-slide"
         style="background-image: url('{{ asset('images/library.jpg') }}');"
         data-title="المكتبة الجامعية"
         data-text="بيئة معرفية تدعم الطلبة بالمراجع والكتب والمحتوى الأكاديمي المنظم.">
    </div>

    <div class="about-slide"
         style="background-image: url('{{ asset('images/computer.jpg') }}');"
         data-title="معامل الحاسب الآلي"
         data-text="مساحات تعليمية مجهزة لدعم الجانب التطبيقي والتقني داخل الجامعة.">
    </div>

    <div class="about-slide"
     style="background-image: url('{{ asset('images/m.jpg') }}');"
     data-title="مرسم وقاعات التصميم"
     data-text="مساحات تعليمية تدعم الجانب الإبداعي والعملي داخل التخصصات الفنية والهندسية.">
</div>

<div class="about-slide"
     style="background-image: url('{{ asset('images/class.jpg') }}');"
     data-title="القاعات الدراسية"
     data-text="بيئة أكاديمية حديثة تساعد الطلبة على التعلم والتفاعل داخل الجامعة.">
</div>



    <div class="about-slide"
         style="background-image: url('{{ asset('images/ph2.jpg') }}');"
         data-title="المعامل والقاعات الدراسية"
         data-text="قاعات ومعامل تساعد الطالب على الجمع بين الجانب النظري والتطبيقي.">
    </div>

    <div class="about-slide"
     style="background-image: url('{{ asset('images/l.jpg') }}');"
     data-text="هوية أكاديمية تعكس رؤية الجامعة في التعليم والبحث والتطوير.">
</div>

    <div class="about-overlay"></div>

    <div class="about-cinematic-content">
        <h1 id="aboutTitle">الجامعة الليبية للعلوم الإنسانية والتطبيقية</h1>
        <p id="aboutText">
            جامعة حاصلة على إذن مزاولة من وزارة التعليم العالي والبحث العلمي، ومعتمدة من المركز الوطني لضمان الجودة.
        </p>

        <div class="about-tags">
            @foreach($departments as $department)
                <a href="{{ route('departments.show', $department->slug) }}">
                    {{ $department->name }}
                </a>
            @endforeach
        </div>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.about-slide');
        const title = document.getElementById('aboutTitle');
        const text = document.getElementById('aboutText');

        let current = 0;

        setInterval(() => {
            slides[current].classList.remove('active');

            current = (current + 1) % slides.length;

            slides[current].classList.add('active');

            title.style.opacity = 0;
            text.style.opacity = 0;

            setTimeout(() => {
                title.textContent = slides[current].dataset.title;
                text.textContent = slides[current].dataset.text;

                title.style.opacity = 1;
                text.style.opacity = 1;
            }, 500);

        }, 5000);
    });
</script>

@endsection