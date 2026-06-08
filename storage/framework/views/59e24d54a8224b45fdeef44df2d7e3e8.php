<?php $__env->startSection('title', __('messages.department') . ' ' . (app()->getLocale() == 'en' ? ucwords(str_replace('-', ' ', $department->slug)) : $department->name)); ?>

<?php $__env->startSection('content'); ?>

<main class="main-content">

    <h2 class="dept-header">
        <?php echo e(__('messages.department')); ?>

        <?php echo e(app()->getLocale() == 'en'
            ? ucwords(str_replace('-', ' ', $department->slug))
            : $department->name); ?>

    </h2>

    <section class="category-box">
        <button class="item" onclick="loadDepartmentContent('channels')">
            <span class="item-icon">📺</span>
            <p><?php echo e(__('messages.educational_channels')); ?></p>
        </button>

        <button class="item active" onclick="loadDepartmentContent('books')">
            <span class="item-icon">📚</span>
            <p><?php echo e(__('messages.books')); ?></p>
        </button>

        <button class="item" onclick="loadDepartmentContent('syllabuses')">
            <span class="item-icon">📖</span>
            <p><?php echo e(__('messages.syllabuses')); ?></p>
        </button>

        <button class="item" onclick="loadDepartmentContent('past-exams')">
            <span class="item-icon">📝</span>
            <p><?php echo e(__('messages.past_exams')); ?></p>
        </button>

        <button class="item" onclick="loadDepartmentContent('researches')">
            <span class="item-icon">🔬</span>
            <p><?php echo e(__('messages.scientific_researches')); ?></p>
        </button>

        <button class="item" onclick="loadDepartmentContent('projects')">
            <span class="item-icon">🎓</span>
            <p><?php echo e(__('messages.graduation_projects')); ?></p>
        </button>
    </section>

    <div class="department-toolbar">
        <div class="sort-box">
            <label><?php echo e(__('messages.sort_content')); ?>:</label>

            <select id="contentSortSelect" onchange="sortContentItems(this.value)">
                <option value="default"><?php echo e(__('messages.default_sort')); ?></option>
                <option value="newest"><?php echo e(__('messages.newest')); ?></option>
                <option value="oldest"><?php echo e(__('messages.oldest')); ?></option>
                <option value="az"><?php echo e(__('messages.name_az')); ?></option>
                <option value="za"><?php echo e(__('messages.name_za')); ?></option>
            </select>
        </div>
    </div>

    <section id="department-content-area" class="display-screen">
        <?php echo $__env->make('departments.partials.file-list', [
            'items' => $books,
            'title' => __('messages.digital_books'),
            'emptyMessage' => __('messages.no_digital_books_department')
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    contentArea.innerHTML = '<p class="empty-message"><?php echo e(__("messages.loading_content")); ?></p>';

    fetch("<?php echo e(url('/departments/' . $department->id . '/content')); ?>/" + type)
        .then(response => response.text())
        .then(html => {
            contentArea.innerHTML = html;

            const select = document.getElementById('contentSortSelect');
            if (select) {
                select.value = 'default';
            }
        })
        .catch(() => {
            contentArea.innerHTML = '<p class="empty-message"><?php echo e(__("messages.loading_error")); ?></p>';
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
    return "<?php echo e(app()->getLocale()); ?>";
}

document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const type = params.get('type');

    if (type) {
        loadDepartmentContent(type);
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/departments/show.blade.php ENDPATH**/ ?>