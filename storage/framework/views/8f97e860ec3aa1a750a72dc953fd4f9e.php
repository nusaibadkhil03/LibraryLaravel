<?php $__env->startSection('content'); ?>

<section class="welcome-banner">
    <div class="welcome-text">
<h1><?php echo e(__('messages.hero_title')); ?></h1>
<p><?php echo e(__('messages.hero_description')); ?></p>
        <div class="action-buttons">
             <a href="<?php echo e(route('about')); ?>" class="btn-primary"><?php echo e(__('messages.about_university')); ?></a>
             <a href="<?php echo e(route('borrow')); ?>" class="btn-secondary"><?php echo e(__('messages.borrow_paper_book')); ?></a>        </div>
    </div>
</section>

<section class="stats-modern-section">
    <div class="stats-header">
        <span><?php echo e(__('messages.overview')); ?></span>
        <h2><?php echo e(__('messages.library_statistics')); ?></h2>
        <p><?php echo e(__('messages.statistics_description')); ?></p>
    </div>

    <div class="stats-modern-grid">

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📚</span>
                <h3 class="counter" data-target="<?php echo e($stats['library_books'] ?? 0); ?>">
                    <?php echo e($stats['library_books'] ?? 0); ?>

                </h3>
        <p><?php echo e(__('messages.book')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height: 85%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🎓</span>
                <h3 class="counter" data-target="<?php echo e($stats['projects'] ?? 0); ?>">
                    <?php echo e($stats['projects'] ?? 0); ?>

                </h3>
                <p><?php echo e(__('messages.graduation_project')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height: 65%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📖</span>
                <h3 class="counter" data-target="<?php echo e($stats['syllabuses'] ?? 0); ?>">
                    <?php echo e($stats['syllabuses'] ?? 0); ?>

                </h3>
                <p><?php echo e(__('messages.syllabus')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height: 75%;"></span>
            </div>
        </div>
         <div class="stat-modern-card">
    <div class="stat-info">
        <span class="stat-icon">🏛️</span>
        <h3 class="counter" data-target="<?php echo e($stats['departments'] ?? 0); ?>">
            <?php echo e($stats['departments'] ?? 0); ?>

        </h3>
        <p><?php echo e(__('messages.academic_department')); ?></p>
    </div>
    <div class="stat-bar">
        <span style="height: 55%;"></span>
    </div>
</div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🔬</span>
                <h3 class="counter" data-target="<?php echo e($stats['researches'] ?? 0); ?>">
                    <?php echo e($stats['researches'] ?? 0); ?>

                </h3>
                <p><?php echo e(__('messages.scientific_research')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height: 55%;"></span>
            </div>
        </div>

    </div>
</section>

<section class="academic-showcase">
    <div class="showcase-header">
        
        <h2><?php echo e(__('messages.quick_window')); ?></h2>
        <p><?php echo e(__('messages.quick_window_description')); ?></p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card">
    <h3><?php echo e(__('messages.most_downloaded_books')); ?></h3>

    <?php $__empty_1 = true; $__currentLoopData = ($mostDownloadedBooks ?? collect())->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(asset('storage/' . $book->file_path)); ?>"
           target="_blank"
           class="mini-book mini-link">
            <div class="mini-icon">📘</div>
            <div>
                <strong><?php echo e($book->title ?? 'عنوان غير متوفر'); ?></strong>
                <p><?php echo e($book->downloads_count ?? 0); ?> تحميل</p>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="empty-text">لا توجد بيانات تحميل حالياً.</p>
    <?php endif; ?>
</div>

        <div class="showcase-card journal-feature"
             style="background-image: url('<?php echo e(asset('images/journals-bg.jpeg')); ?>');">
            <div class="journal-overlay">
                
                <h3><?php echo e(__('messages.university_journals')); ?></h3>
                <p><?php echo e(__('messages.university_journals_description')); ?></p>
                <a href="<?php echo e(route('journals')); ?>" class="journal-btn"><?php echo e(__('messages.browse_journals')); ?></a>
            </div>
        </div>

        <div class="showcase-card updates-card">
    <h3><?php echo e(__('messages.latest_academic_additions')); ?></h3>

    <?php if(isset($latestBooks) && $latestBooks->count()): ?>
        <a href="<?php echo e(asset('storage/' . $latestBooks->first()->file_path)); ?>"
           target="_blank"
           class="update-item mini-link">
            <span>📚</span>
            <div>
                <strong><?php echo e(__('messages.new_book')); ?></strong>
                <p><?php echo e($latestBooks->first()->title ?? __('messages.new_book_added')); ?></p>
            </div>
        </a>
    <?php endif; ?>

    <?php if(isset($latestProjects) && $latestProjects->count()): ?>
        <a href="<?php echo e(route('projects')); ?>"
           class="update-item mini-link">
            <span>🎓</span>
            <div>
                <strong><?php echo e(__('messages.graduation_project')); ?></strong>
                <p><?php echo e($latestProjects->first()->title ?? __('messages.new_project_added')); ?></p>
            </div>
        </a>
    <?php endif; ?>

    <?php if(isset($latestJournals) && $latestJournals->count()): ?>
        <a href="<?php echo e(route('journals')); ?>"
           class="update-item mini-link">
            <span>🧾</span>
            <div>
                <strong><?php echo e(__('messages.research_or_journal')); ?></strong>
                <p><?php echo e($latestJournals->first()->title ?? 'تمت إضافة إصدار جديد'); ?></p>
            </div>
        </a>
    <?php endif; ?>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/home.blade.php ENDPATH**/ ?>