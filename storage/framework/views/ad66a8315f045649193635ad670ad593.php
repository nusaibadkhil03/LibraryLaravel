

<?php $__env->startSection('content'); ?>

<?php if(session('auth_required')): ?>
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
        <?php echo e(session('auth_required')); ?>

    </div>

    <script>
        setTimeout(() => {
            const popup = document.getElementById('auth-popup');
            if (popup) popup.style.display = 'none';
        }, 3000);
    </script>
<?php endif; ?>

<section class="welcome-banner">
    <div class="welcome-text">
        <h1><?php echo e(__('messages.hero_title')); ?></h1>

        <p>
            <?php echo e(__('messages.hero_description_guest')); ?>

        </p>

        <div class="action-buttons">
            <a href="#services" class="btn-primary">
                <?php echo e(__('messages.explore_services')); ?>

            </a>

            <a href="<?php echo e(route('about')); ?>" class="btn-secondary">
                <?php echo e(__('messages.about_university')); ?>

            </a>
        </div>
    </div>
</section>

<section class="stats-modern-section">
    <div class="stats-header">
        <span><?php echo e(__('messages.overview')); ?></span>
        <h2><?php echo e(__('messages.library_statistics_digital')); ?></h2>
        <p><?php echo e(__('messages.statistics_description')); ?></p>
    </div>

    <div class="stats-modern-grid">

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">📚</span>
                <h3><?php echo e($stats['library_books'] ?? $stats['books'] ?? 0); ?></h3>
                <p><?php echo e(__('messages.academic_book_reference')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height:85%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🎓</span>
                <h3><?php echo e($stats['projects'] ?? 0); ?></h3>
                <p><?php echo e(__('messages.graduation_project')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height:65%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🏛️</span>
                <h3><?php echo e($stats['departments'] ?? 0); ?></h3>
                <p><?php echo e(__('messages.academic_department')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height:45%;"></span>
            </div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🧾</span>
                <h3><?php echo e($stats['researches'] ?? 0); ?></h3>
                <p><?php echo e(__('messages.research_or_journal')); ?></p>
            </div>
            <div class="stat-bar">
                <span style="height:55%;"></span>
            </div>
        </div>

    </div>
</section>

<section class="academic-showcase" id="services">
    <div class="showcase-header">
        <span><?php echo e(__('messages.featured_content')); ?></span>
        <h2><?php echo e(__('messages.quick_window')); ?></h2>
        <p><?php echo e(__('messages.guest_quick_description')); ?></p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card guest-info-card">
            <h3><?php echo e(__('messages.digital_books')); ?></h3>

            <div class="locked-preview-item">
                <div class="mini-icon">📚</div>
                <div>
                    <strong><?php echo e(__('messages.academic_books_references')); ?></strong>
                    <p><?php echo e(__('messages.digital_books_description')); ?></p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">🔒</div>
                <div>
                    <strong><?php echo e(__('messages.login_required')); ?></strong>
                    <p><?php echo e(__('messages.login_required_books')); ?></p>
                </div>
            </div>

            <a href="<?php echo e(route('guest.blocked')); ?>" class="showcase-btn guest-popup-btn">
                <?php echo e(__('messages.browse_books')); ?>

            </a>
        </div>

        <div class="showcase-card journal-feature"
             style="background-image: url('<?php echo e(asset('images/journals-bg.jpeg')); ?>');">
            <div class="journal-overlay">
                <div class="journal-icon">📘</div>

                <h3><?php echo e(__('messages.university_journals')); ?></h3>
                <p><?php echo e(__('messages.university_journals_description')); ?></p>

                <a href="<?php echo e(route('journals')); ?>" class="journal-btn">
                    <?php echo e(__('messages.browse_journals')); ?>

                </a>
            </div>
        </div>

        <div class="showcase-card updates-card guest-info-card">
            <h3><?php echo e(__('messages.about_university')); ?></h3>

            <div class="locked-preview-item">
                <div class="mini-icon">🏛️</div>
                <div>
                    <strong><?php echo e(__('messages.general_info')); ?></strong>
                    <p><?php echo e(__('messages.university_info_description')); ?></p>
                </div>
            </div>

            <div class="locked-preview-item">
                <div class="mini-icon">✅</div>
                <div>
                    <strong><?php echo e(__('messages.available_for_guest')); ?></strong>
                    <p><?php echo e(__('messages.guest_about_description')); ?></p>
                </div>
            </div>

            <a href="<?php echo e(route('about')); ?>" class="showcase-btn">
                <?php echo e(__('messages.open_about_page')); ?>

            </a>
        </div>

    </div>
</section>

<div style="margin:35px 0; text-align:center;">
    <a href="<?php echo e(route('login')); ?>" class="btn-primary" style="margin-left:10px;">
        <?php echo e(__('messages.login')); ?>

    </a>

    <a href="<?php echo e(route('register')); ?>" class="btn-secondary">
        <?php echo e(__('messages.register')); ?>

    </a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/home_guest.blade.php ENDPATH**/ ?>