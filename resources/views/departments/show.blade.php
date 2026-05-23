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

    <div class="department-toolbar">
        <div class="sort-box">
            <label>ترتيب المحتوى:</label>

            <select id="contentSortSelect" onchange="sortContentItems(this.value)">
                <option value="default">الترتيب الافتراضي</option>
                <option value="newest">الأحدث</option>
                <option value="oldest">الأقدم</option>
                <option value="az">الاسم (أ - ي)</option>
                <option value="za">الاسم (ي - أ)</option>
            </select>
        </div>
    </div>

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

            const select = document.getElementById('contentSortSelect');
            if (select) {
                select.value = 'default';
            }
        })
        .catch(() => {
            contentArea.innerHTML = '<p class="empty-message">حدث خطأ أثناء تحميل المحتوى</p>';
        });
}

function sortContentItems(type) {
    const list = document.querySelector('#department-content-area .content-list');
    if (!list) return;

    const items = Array.from(list.querySelectorAll('.content-row'));

    items.sort((a, b) => {
        const titleA = (a.dataset.title || '').trim();
        const titleB = (b.dataset.title || '').trim();

        const yearA = extractYear(a.dataset.year);
        const yearB = extractYear(b.dataset.year);

        if (type === 'newest') {
            return yearB - yearA;
        }

        if (type === 'oldest') {
            return yearA - yearB;
        }

        if (type === 'az') {
            return titleA.localeCompare(titleB, 'ar');
        }

        if (type === 'za') {
            return titleB.localeCompare(titleA, 'ar');
        }

        return 0;
    });

    items.forEach(item => list.appendChild(item));
}

function extractYear(value) {
    const match = String(value || '').match(/\d{4}/);
    return match ? parseInt(match[0]) : 0;
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