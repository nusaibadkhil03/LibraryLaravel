<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>

<body class="borrow-page">

    <div class="borrow-overlay">
        <div class="borrow-box">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
     <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/layouts/borrow_layout.blade.php ENDPATH**/ ?>