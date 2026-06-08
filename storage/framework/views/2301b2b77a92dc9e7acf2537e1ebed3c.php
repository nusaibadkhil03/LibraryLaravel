<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>"
      dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', __('messages.library_name')); ?></title>
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

        .favorite-btn {
            border: none;
            background: #fff7ed;
            color: #f97316;
            padding: 10px 13px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 17px;
            margin-left: 8px;
            transition: 0.3s;
        }

        .favorite-btn:hover {
            background: #ffedd5;
            transform: translateY(-2px);
        }

        .success-toast {
            position: fixed;
            top: 25px;
            left: 25px;
            z-index: 9999;
            background: #16a34a;
            color: white;
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: slideIn 0.4s ease;
        }

        html[dir="rtl"] .success-toast {
            left: 25px;
            right: auto;
        }

        html[dir="ltr"] .success-toast {
            right: 25px;
            left: auto;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-row {
            width: 260px;
            min-height: auto !important;
            padding: 18px;
            border-radius: 16px;
            background: #fff;
        }

        .content-info {
            width: 100%;
        }

        .content-main-title {
            display: block;
            font-size: 17px;
            margin-bottom: 12px;
            color: #222;
        }

        .content-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .content-meta span {
            background: #fff7ed;
            color: #555;
            border: 1px solid #fed7aa;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .content-description {
            font-size: 13px;
            color: #666;
            line-height: 1.7;
            margin: 8px 0 12px;
        }

        .content-action {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
        }

        .download-btn {
            flex: 1;
            text-align: center;
        }
    </style>
</head>

<body>

<header class="site-header">
    <div class="header-wrapper">

        <div class="header-top-row">

            <div class="header-logo-search">
                <img src="<?php echo e(asset('images/logo.png')); ?>"
                     alt="<?php echo e(__('messages.logo_alt')); ?>"
                     class="logo-img">

                <div class="search-container">
                    <input
                        type="text"
                        id="liveSearchInput"
                        name="q"
                        placeholder="<?php echo e(__('messages.search_placeholder')); ?>"
                        autocomplete="off"
                    >

                    <button type="button" class="search-icon">🔍</button>

                    <div id="liveSearchResults" class="live-search-results"></div>
                </div>
            </div>

            <div class="header-title">
                <h2><?php echo e(__('messages.library_name')); ?></h2>
                <p><?php echo e(__('messages.platform_name')); ?></p>
            </div>

            <div class="header-actions">
                <?php if(app()->getLocale() == 'ar'): ?>
                    <a href="<?php echo e(route('language.switch', 'en')); ?>" class="btn-white">EN</a>
                <?php else: ?>
                    <a href="<?php echo e(route('language.switch', 'ar')); ?>" class="btn-white">AR</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn-white">
                        <?php echo e(Auth::user()->name); ?>

                    </a>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-white">
                            <?php echo e(__('messages.logout')); ?>

                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn-white">
                        <?php echo e(__('messages.register')); ?>

                    </a>

                    <a href="<?php echo e(route('login')); ?>" class="btn-white" title="<?php echo e(__('messages.login')); ?>">
                        👤
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <nav class="main-menu">
            <ul>

                <li>
                    <a href="<?php echo e(url('/')); ?>">
                        <?php echo e(__('messages.home')); ?>

                    </a>
                </li>

                <li class="dropdown">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="#" class="dropbtn">
                            <?php echo e(__('messages.departments')); ?> ▼
                        </a>

                        <div class="dropdown-content">
    <?php if(isset($departments)): ?>
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('departments.show', $department->slug)); ?>">
                <?php echo e(app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
                    <?php else: ?>
                        <a href="#" class="dropbtn guest-popup-btn">
                            <?php echo e(__('messages.departments')); ?> ▼
                        </a>

<div class="dropdown-content">
    <?php if(isset($departments)): ?>
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#" class="guest-popup-btn">
                <?php echo e(app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>                    <?php endif; ?>
                </li>

                <li>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('curriculum')); ?>">
                            <?php echo e(__('messages.curriculum')); ?>

                        </a>
                    <?php else: ?>
                        <a href="#" class="guest-popup-btn">
                            <?php echo e(__('messages.curriculum')); ?>

                        </a>
                    <?php endif; ?>
                </li>

                <li>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('borrow')); ?>">
                            <?php echo e(__('messages.borrow_book')); ?>

                        </a>
                    <?php else: ?>
                        <a href="#" class="guest-popup-btn">
                            <?php echo e(__('messages.borrow_book')); ?>

                        </a>
                    <?php endif; ?>
                </li>

                <li>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('favorites.index')); ?>"
                           title="<?php echo e(__('messages.favorites')); ?>">
                            ⭐
                        </a>
                    <?php else: ?>
                        <a href="#"
                           class="guest-popup-btn"
                           title="<?php echo e(__('messages.favorites')); ?>">
                            ⭐
                        </a>
                    <?php endif; ?>
                </li>

            </ul>
        </nav>

    </div>
</header>

<?php if(session('success')): ?>
    <div id="success-message" class="success-toast">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<main class="container">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer class="main-footer">
    <div class="footer-container">

        <div class="footer-section footer-about">
            <h3><?php echo e(__('messages.library_name')); ?></h3>
            <p>
                <?php echo e(__('messages.footer_about')); ?>

            </p>
        </div>

        <div class="footer-section">
            <h3><?php echo e(__('messages.quick_links')); ?></h3>
            <ul>
                <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('messages.home')); ?></a></li>
                <li><a href="<?php echo e(route('about')); ?>"><?php echo e(__('messages.about_university')); ?></a></li>
                <li><a href="<?php echo e(route('journals')); ?>"><?php echo e(__('messages.journals')); ?></a></li>

                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('curriculum')); ?>"><?php echo e(__('messages.curriculum')); ?></a></li>
                    <li><a href="<?php echo e(route('borrow')); ?>"><?php echo e(__('messages.borrow_book')); ?></a></li>
                    <li><a href="#services"><?php echo e(__('messages.services')); ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a></li>
                    <li><a href="<?php echo e(route('register')); ?>"><?php echo e(__('messages.register')); ?></a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section">
            <h3><?php echo e(__('messages.platform_services')); ?></h3>
            <ul>
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('curriculum')); ?>"><?php echo e(__('messages.curriculum_and_plans')); ?></a></li>
                    <li><a href="<?php echo e(route('borrow')); ?>"><?php echo e(__('messages.borrow_requests')); ?></a></li>
                    <li><a href="<?php echo e(route('journals')); ?>"><?php echo e(__('messages.scientific_journals')); ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('guest.blocked')); ?>"><?php echo e(__('messages.digital_books')); ?></a></li>
                    <li><a href="<?php echo e(route('guest.blocked')); ?>"><?php echo e(__('messages.curriculum')); ?></a></li>
                    <li><a href="<?php echo e(route('journals')); ?>"><?php echo e(__('messages.scientific_journals')); ?></a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section footer-contact">
            <h3><?php echo e(__('messages.contact_us')); ?></h3>

            <p>
                📍
                <a href="https://maps.apple.com/place?coordinate=32.90753410%2C13.18115658"
                   target="_blank">
                    <?php echo e(__('messages.university_location')); ?>

                </a>
            </p>

            <p>
                🌐
                <a href="https://libyanuniv.edu.ly"
                   target="_blank">
                    <?php echo e(__('messages.official_website')); ?>

                </a>
            </p>

            <p>🕘 <?php echo e(__('messages.work_days')); ?></p>

            <p>⏰ <?php echo e(__('messages.work_hours')); ?></p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>
            © <?php echo e(date('Y')); ?> <?php echo e(__('messages.copyright')); ?>

        </p>
    </div>
</footer>

<?php if(auth()->guard()->guest()): ?>
<div id="authModal" class="auth-modal">
    <div class="auth-modal-box">
        <button class="auth-close-btn" id="closeAuthModal">&times;</button>

        <div class="auth-modal-icon">🔒</div>
        <h2><?php echo e(__('messages.login_required_title')); ?></h2>
        <p><?php echo e(__('messages.login_required_text')); ?></p>

        <div class="auth-modal-actions">
            <a href="<?php echo e(route('login')); ?>" class="auth-btn primary">
                <?php echo e(__('messages.login')); ?>

            </a>

            <a href="<?php echo e(route('register')); ?>" class="auth-btn secondary">
                <?php echo e(__('messages.register')); ?>

            </a>
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
setTimeout(() => {
    const message = document.getElementById('success-message');

    if(message){
        message.style.transition = '0.5s';
        message.style.opacity = '0';

        setTimeout(() => {
            message.remove();
        }, 500);
    }
}, 2500);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
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
                    : `<div class="live-search-empty">${<?php echo json_encode(__('messages.no_results'), 15, 512) ?>}</div>`;

                box.style.display = 'block';
            });
    });
});
</script>

</body>
</html>
<?php /**PATH C:\course laravel\LibraryLaravel\resources\views/layouts/main.blade.php ENDPATH**/ ?>