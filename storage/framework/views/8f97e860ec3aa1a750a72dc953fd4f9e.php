<?php $__env->startSection('content'); ?>

<section class="welcome-banner">
    <div class="welcome-text">
        <h1>مرحباً بك في مكتبة الجامعة الليبية الإلكترونية</h1>
        <p>بوابتك الرقمية الشاملة للمراجع الأكاديمية، المناهج الدراسية، وتوثيقات مشاريع التخرج.</p>

        <div class="action-buttons">
            <a href="<?php echo e(route('about')); ?>" class="btn-primary">عن الجامعة</a>
            <a href="<?php echo e(route('borrow')); ?>" class="btn-secondary">استعارة كتاب ورقي</a>
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
                <h3 class="counter" data-target="<?php echo e($stats['books'] ?? 0); ?>"><?php echo e($stats['books'] ?? 0); ?></h3>
                <p>كتاب ومرجع أكاديمي</p>
            </div>
            <div class="stat-bar"><span style="height: 85%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🎓</span>
                <h3 class="counter" data-target="<?php echo e($stats['projects'] ?? 0); ?>"><?php echo e($stats['projects'] ?? 0); ?></h3>
                <p>مشروع تخرج</p>
            </div>
            <div class="stat-bar"><span style="height: 65%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🏛️</span>
                <h3 class="counter" data-target="<?php echo e($stats['departments'] ?? 0); ?>"><?php echo e($stats['departments'] ?? 0); ?></h3>
                <p>قسم أكاديمي</p>
            </div>
            <div class="stat-bar"><span style="height: 45%;"></span></div>
        </div>

        <div class="stat-modern-card">
            <div class="stat-info">
                <span class="stat-icon">🧾</span>
                <h3 class="counter" data-target="<?php echo e($stats['researches'] ?? 0); ?>"><?php echo e($stats['researches'] ?? 0); ?></h3>
                <p>بحث أو مجلة علمية</p>
            </div>
            <div class="stat-bar"><span style="height: 55%;"></span></div>
        </div>
    </div>
</section>

<section class="academic-showcase">
    <div class="showcase-header">
        
        <h2>نافذة سريعة على المكتبة الرقمية</h2>
        <p>وصول سريع لأهم المحتويات الأكاديمية المضافة داخل المنصة.</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card downloads-card">
    <h3>أكثر الكتب الرقمية تحميلًا</h3>

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
                
                <h3>مجلات الجامعة</h3>
                <p>تصفح الإصدارات العلمية والمجلات الأكاديمية الخاصة بالجامعة.</p>
                <a href="<?php echo e(route('journals')); ?>" class="journal-btn">استعراض المجلات</a>
            </div>
        </div>

        <div class="showcase-card updates-card">
    <h3>آخر الإضافات الأكاديمية</h3>

    <?php if(isset($latestBooks) && $latestBooks->count()): ?>
        <a href="<?php echo e(asset('storage/' . $latestBooks->first()->file_path)); ?>"
           target="_blank"
           class="update-item mini-link">
            <span>📚</span>
            <div>
                <strong>كتاب جديد</strong>
                <p><?php echo e($latestBooks->first()->title ?? 'تمت إضافة كتاب جديد'); ?></p>
            </div>
        </a>
    <?php endif; ?>

    <?php if(isset($latestProjects) && $latestProjects->count()): ?>
        <a href="<?php echo e(route('projects')); ?>"
           class="update-item mini-link">
            <span>🎓</span>
            <div>
                <strong>مشروع تخرج</strong>
                <p><?php echo e($latestProjects->first()->title ?? 'تمت إضافة مشروع جديد'); ?></p>
            </div>
        </a>
    <?php endif; ?>

    <?php if(isset($latestJournals) && $latestJournals->count()): ?>
        <a href="<?php echo e(route('journals')); ?>"
           class="update-item mini-link">
            <span>🧾</span>
            <div>
                <strong>بحث أو مجلة</strong>
                <p><?php echo e($latestJournals->first()->title ?? 'تمت إضافة إصدار جديد'); ?></p>
            </div>
        </a>
    <?php endif; ?>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/home.blade.php ENDPATH**/ ?>