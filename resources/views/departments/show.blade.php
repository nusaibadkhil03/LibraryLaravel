@extends('layouts.main')

@section('title', 'قسم ' . $department->name)

@section('content')

<main class="main-content">

    <h2 class="dept-header">
        قسم {{ $department->name }}
    </h2>

    <section class="category-box">
        <button class="item" onclick="loadDepartmentContent('channels')">
            <span class="item-icon">📺</span>
            <p>قنوات تعليمية</p>
        </button>

        <button class="item active" onclick="loadDepartmentContent('books')">
            <span class="item-icon">📚</span>
            <p>الكتب</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('syllabuses')">
            <span class="item-icon">📖</span>
            <p>المناهج</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('past-exams')">
            <span class="item-icon">📝</span>
            <p>أسئلة سنوات سابقة</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('researches')">
          <span class="item-icon">🔬</span>
         <p>البحوث العلمية</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('projects')">
            <span class="item-icon">🎓</span>
            <p>مشاريع تخرج</p>
        </button>
    </section>

    <section id="department-content-area" class="display-screen">
        @include('departments.partials.file-list', [
            'items' => $books,
            'title' => 'الكتب الرقمية',
            'emptyMessage' => 'لا توجد كتب رقمية مضافة لهذا القسم حالياً.'
        ])
    </section>

</main>

<script>
function loadDepartmentContent(type) {
    const buttons = document.querySelectorAll('.category-box .item');

    buttons.forEach(button => {
        button.classList.remove('active');

        const onclickValue = button.getAttribute('onclick') || '';
        if (onclickValue.includes(type)) {
            button.classList.add('active');
        }
    });

    const contentArea = document.getElementById('department-content-area');
    contentArea.innerHTML = '<p class="empty-message">جاري تحميل المحتوى...</p>';

    fetch("{{ url('/departments/' . $department->id . '/content') }}/" + type)
        .then(response => response.text())
        .then(html => {
            contentArea.innerHTML = html;
        })
        .catch(() => {
            contentArea.innerHTML = '<p class="empty-message">حدث خطأ أثناء تحميل المحتوى</p>';
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const type = params.get('type');

    if (type) {
        loadDepartmentContent(type);
    }
});
</script>

@endsection