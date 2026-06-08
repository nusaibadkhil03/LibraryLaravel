@extends('layouts.main')

@section('title', __('messages.department') . ' ' . (app()->getLocale() == 'en' ? ucwords(str_replace('-', ' ', $department->slug)) : $department->name))

@section('content')

<main class="main-content">

    <h2 class="dept-header">
        {{ __('messages.department') }}
        {{ app()->getLocale() == 'en'
            ? ucwords(str_replace('-', ' ', $department->slug))
            : $department->name }}
    </h2>

    <section class="category-box">
        <button class="item" onclick="loadDepartmentContent('channels')">
            <span class="item-icon">📺</span>
            <p>{{ __('messages.educational_channels') }}</p>
        </button>

        <button class="item active" onclick="loadDepartmentContent('books')">
            <span class="item-icon">📚</span>
            <p>{{ __('messages.books') }}</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('syllabuses')">
            <span class="item-icon">📖</span>
            <p>{{ __('messages.syllabuses') }}</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('past-exams')">
            <span class="item-icon">📝</span>
            <p>{{ __('messages.past_exams') }}</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('researches')">
            <span class="item-icon">🔬</span>
            <p>{{ __('messages.scientific_researches') }}</p>
        </button>

        <button class="item" onclick="loadDepartmentContent('projects')">
            <span class="item-icon">🎓</span>
            <p>{{ __('messages.graduation_projects') }}</p>
        </button>
    </section>

    <div class="department-toolbar">
        <div class="sort-box">
            <label>{{ __('messages.sort_content') }}:</label>

            <select id="contentSortSelect" onchange="sortContentItems(this.value)">
                <option value="default">{{ __('messages.default_sort') }}</option>
                <option value="newest">{{ __('messages.newest') }}</option>
                <option value="oldest">{{ __('messages.oldest') }}</option>
                <option value="az">{{ __('messages.name_az') }}</option>
                <option value="za">{{ __('messages.name_za') }}</option>
            </select>
        </div>
    </div>

    <section id="department-content-area" class="display-screen">
        @include('departments.partials.file-list', [
            'items' => $books,
            'title' => __('messages.digital_books'),
            'emptyMessage' => __('messages.no_digital_books_department')
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
    contentArea.innerHTML = '<p class="empty-message">{{ __("messages.loading_content") }}</p>';

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
            contentArea.innerHTML = '<p class="empty-message">{{ __("messages.loading_error") }}</p>';
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
            return titleA.localeCompare(titleB, appLocale());
        }

        if (type === 'za') {
            return titleB.localeCompare(titleA, appLocale());
        }

        return 0;
    });

    items.forEach(item => list.appendChild(item));
}

function extractYear(value) {
    const match = String(value || '').match(/\d{4}/);
    return match ? parseInt(match[0]) : 0;
}

function appLocale() {
    return "{{ app()->getLocale() }}";
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