@extends('layouts.main')

@section('content')

@php
    $slides = [
        [
            'image' => 'images/campus.jpeg',
            'title' => 'الجامعة الليبية للعلوم الإنسانية والتطبيقية',
            'text' => 'جامعة حاصلة على إذن مزاولة من وزارة التعليم العالي والبحث العلمي، ومعتمدة من المركز الوطني لضمان الجودة.'
        ],
        [
            'image' => 'images/library.jpg',
            'title' => 'المكتبة الجامعية',
            'text' => 'بيئة معرفية تدعم الطلبة بالمراجع والكتب والمحتوى الأكاديمي المنظم.'
        ],
        [
            'image' => 'images/computer.jpg',
            'title' => 'معامل الحاسب الآلي',
            'text' => 'مساحات تعليمية مجهزة لدعم الجانب التطبيقي والتقني داخل الجامعة.'
        ],
        [
            'image' => 'images/m.jpg',
            'title' => 'مرسم وقاعات التصميم',
            'text' => 'مساحات تعليمية تدعم الجانب الإبداعي والعملي داخل التخصصات الفنية والهندسية.'
        ],
        [
            'image' => 'images/class.jpg',
            'title' => 'القاعات الدراسية',
            'text' => 'بيئة أكاديمية حديثة تساعد الطلبة على التعلم والتفاعل داخل الجامعة.'
        ],
        [
            'image' => 'images/ph2.jpg',
            'title' => 'المعامل والقاعات الدراسية',
            'text' => 'قاعات ومعامل تساعد الطالب على الجمع بين الجانب النظري والتطبيقي.'
        ],
        [
            'image' => 'images/l.jpg',
            'title' => 'هوية الجامعة',
            'text' => 'هوية أكاديمية تعكس رؤية الجامعة في التعليم والبحث والتطوير.'
        ],
    ];
@endphp

<section class="about-cinematic">

    @foreach($slides as $index => $slide)
        <div class="about-slide {{ $index === 0 ? 'active' : '' }}"
             style="background-image: url('{{ asset($slide['image']) }}');"
             data-title="{{ $slide['title'] }}"
             data-text="{{ $slide['text'] }}">
        </div>
    @endforeach

    <div class="about-overlay"></div>

    <div class="about-cinematic-content">
        <h1 id="aboutTitle">{{ $slides[0]['title'] }}</h1>

        <p id="aboutText">
            {{ $slides[0]['text'] }}
        </p>

        <div class="about-tags">
            @isset($departments)
                @forelse($departments as $department)
                    <a href="{{ route('departments.show', $department->slug) }}">
                        {{ $department->name }}
                    </a>
                @empty
                    <span>لا توجد أقسام حالياً</span>
                @endforelse
            @endisset
        </div>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.about-slide');
    const title = document.getElementById('aboutTitle');
    const text = document.getElementById('aboutText');

    if (!slides.length || !title || !text) return;

    let current = 0;

    setInterval(() => {
        slides[current].classList.remove('active');

        current = (current + 1) % slides.length;

        slides[current].classList.add('active');

        title.style.opacity = 0;
        text.style.opacity = 0;

        setTimeout(() => {
            title.textContent = slides[current].dataset.title || '';
            text.textContent = slides[current].dataset.text || '';

            title.style.opacity = 1;
            text.style.opacity = 1;
        }, 500);

    }, 4000);
});
</script>

@endsection