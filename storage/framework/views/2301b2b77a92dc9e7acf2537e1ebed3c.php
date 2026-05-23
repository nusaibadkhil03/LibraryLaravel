<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الجامعة الليبية</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <style>
.header-container {
    max-width: 1200px !important;
    margin: 0 auto !important;
    display: grid !important;
    grid-template-columns: auto 1fr auto !important;
    align-items: center !important;
    padding: 0px !important;
}
</style>
</head>
<body>

<header class="site-header">
    <div class="header-wrapper">

        <div class="header-top-row">

         <div class="header-logo-search">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="شعار المكتبة" class="logo-img">

    <div class="search-container">
        <input
            type="text"
            id="liveSearchInput"
            name="q"
            placeholder="ابحث عن كتاب، منهج، أو مشروع..."
            autocomplete="off"
        >

        <button type="button" class="search-icon">🔍</button>

        <div id="liveSearchResults" class="live-search-results"></div>
    </div>
</div>
            
            <div class="header-title">
                <h2>مكتبة الجامعة الليبية</h2>
                <p>منصة الكتب الأكاديمية</p>
            </div>

            
            <div class="header-actions">
                <button class="btn-white">EN/AR</button>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn-white">
                        <?php echo e(Auth::user()->name); ?>

                    </a>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-white">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn-white">Sign up</a>
                    <a href="<?php echo e(route('login')); ?>" class="btn-white">👤</a>
                <?php endif; ?>
            </div>

        </div>

        <nav class="main-menu">
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">الرئيسية</a></li>

                <li class="dropdown">
    <?php if(auth()->guard()->check()): ?>
        <a href="#" class="dropbtn">الأقسام ▼</a>
        <div class="dropdown-content">
            <?php if(isset($departments)): ?>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('departments.show', $department->slug)); ?>">
                        <?php echo e($department->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <a href="#" class="dropbtn guest-popup-btn">الأقسام ▼</a>
        <div class="dropdown-content">
            <?php if(isset($departments)): ?>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="guest-popup-btn"><?php echo e($department->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</li>

                <li>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('curriculum')); ?>">الخطة الدراسية</a>
                    <?php else: ?>
                        <a href="#" class="guest-popup-btn">الخطة الدراسية</a>
                    <?php endif; ?>
                </li>

                <li>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('borrow')); ?>">استعارة كتاب</a>
                    <?php else: ?>
                        <a href="#" class="guest-popup-btn">استعارة كتاب</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>

    </div>
</header>

<main class="container">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer class="main-footer">
    <div class="footer-container">

        <div class="footer-section footer-about">
            <h3>مكتبة الجامعة الليبية</h3>
            <p>
                منصة أكاديمية رقمية تهدف إلى تنظيم المحتوى العلمي وتسهيل وصول الطلاب إلى الكتب، المناهج، المجلات، والمشاريع الجامعية.
            </p>
        </div>

        <div class="footer-section">
            <h3>روابط سريعة</h3>
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">الرئيسية</a></li>
                <li><a href="<?php echo e(route('about')); ?>">عن الجامعة</a></li>
                <li><a href="<?php echo e(route('journals')); ?>">المجلات</a></li>

                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('curriculum')); ?>">الخطة الدراسية</a></li>
                    <li><a href="<?php echo e(route('borrow')); ?>">استعارة كتاب</a></li>
                    <li><a href="#services">الخدمات</a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a></li>
                    <li><a href="<?php echo e(route('register')); ?>">إنشاء حساب</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section">
            <h3>خدمات المنصة</h3>
            <ul>
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('curriculum')); ?>">المناهج والخطة الدراسية</a></li>
                    <li><a href="<?php echo e(route('borrow')); ?>">طلبات الاستعارة</a></li>
                    <li><a href="<?php echo e(route('journals')); ?>">المجلات العلمية</a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('guest.blocked')); ?>">الكتب الرقمية</a></li>
                    <li><a href="<?php echo e(route('guest.blocked')); ?>">المناهج الدراسية</a></li>
                    <li><a href="<?php echo e(route('journals')); ?>">المجلات العلمية</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section footer-contact">
    <h3>تواصل معنا</h3>

    <p>
        📍
        <a href="https://maps.apple.com/place?coordinate=32.90753410%2C13.18115658"
           target="_blank">
            موقع الجامعة على الخريطة
        </a>
    </p>

    <p>
        🌐
        <a href="https://libyanuniv.edu.ly"
           target="_blank">
            الموقع الرسمي للجامعة الليبية
        </a>
    </p>

    

    <p>🕘 السبت - الخميس</p>

    <p>⏰ 08:00 صباحًا - 05:00 عصرًا</p>
</div>

    </div>

    <div class="footer-bottom">
        <p>
            © <?php echo e(date('Y')); ?> مكتبة الجامعة الليبية - جميع الحقوق محفوظة
        </p>
    </div>
</footer>
<?php if(auth()->guard()->guest()): ?>
<div id="authModal" class="auth-modal">
    <div class="auth-modal-box">
        <button class="auth-close-btn" id="closeAuthModal">&times;</button>

        <div class="auth-modal-icon">🔒</div>
        <h2>يجب تسجيل الدخول أولاً</h2>
        <p>للوصول إلى الأقسام والخدمات الأكاديمية، يرجى تسجيل الدخول أو إنشاء حساب جديد.</p>

        <div class="auth-modal-actions">
            <a href="<?php echo e(route('login')); ?>" class="auth-btn primary">تسجيل الدخول</a>
            <a href="<?php echo e(route('register')); ?>" class="auth-btn secondary">إنشاء حساب</a>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(auth()->guard()->guest()): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('authModal');
    const openButtons = document.querySelectorAll('.guest-popup-btn');
    const closeButton = document.getElementById('closeAuthModal');

    openButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.add('show');
        });
    });

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    }
});

</script>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('live search loaded');

    const input = document.getElementById('liveSearchInput');
    const box = document.getElementById('liveSearchResults');

    if (!input || !box) return;

    input.addEventListener('input', function () {
        const q = this.value.trim();

        if (q.length < 2) {
            box.innerHTML = '';
            box.style.display = 'none';
            return;
        }

        fetch(`/live-search?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                box.innerHTML = data.length
                    ? data.map(item => `
                        <a href="${item.url}" class="live-search-item">
                            <span>${item.title}</span>
                            <small>${item.type}</small>
                        </a>
                    `).join('')
                    : '<div class="live-search-empty">لا توجد نتائج</div>';

                box.style.display = 'block';
            });
    });
});
</script>
</body>
</html><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/layouts/main.blade.php ENDPATH**/ ?>