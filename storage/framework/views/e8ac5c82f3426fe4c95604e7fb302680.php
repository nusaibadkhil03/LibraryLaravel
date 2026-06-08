<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>"
      dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
    
</head>
<body>

<div class="auth-wrapper">
    <div class="overlay"></div>

    <div class="login-container">
        <?php echo $__env->yieldContent('form_body'); ?>
    </div>
</div>

</body>
</html><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/layouts/form_layout.blade.php ENDPATH**/ ?>