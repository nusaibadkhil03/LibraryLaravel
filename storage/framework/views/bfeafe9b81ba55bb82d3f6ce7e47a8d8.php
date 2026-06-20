<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>"
      dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('messages.favorites')); ?></title>

    <style>
body {
    margin: 0;
    font-family: Tahoma, Arial, sans-serif;
    background: #f6f7fb;
    color: #222;
}

.favorites-header {
    background: linear-gradient(135deg, #f97316, #fb8c2e);
    color: white;
    padding: 22px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 8px 22px rgba(249, 115, 22, 0.22);
}

.favorites-header h2 {
    margin: 0;
    font-size: 25px;
}

.favorites-header a {
    background: white;
    color: #f97316;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 22px;
    font-weight: bold;
}

.favorites-container {
    max-width: 1100px;
    margin: 35px auto;
    padding: 0 20px;
}

.favorite-card {
    background: white;
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 18px;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: space-between;
    gap: 22px;
    align-items: center;
    border: 1px solid #f1f1f1;
}

.favorite-info {
    flex: 1;
}

.favorite-info h3 {
    margin: 0 0 10px;
    color: #1f2937;
    font-size: 20px;
}

.favorite-info p {
    margin: 5px 0;
    color: #666;
    line-height: 1.7;
    font-size: 14px;
}

.favorite-type {
    display: inline-block;
    background: #fff3e8;
    color: #f97316;
    padding: 6px 13px;
    border-radius: 20px;
    font-size: 13px;
    margin-bottom: 10px;
    font-weight: bold;
}

.favorite-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.favorite-actions a,
.favorite-actions button {
    border: none;
    text-decoration: none;
    padding: 11px 17px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
    font-family: inherit;
    font-size: 14px;
}

.open-btn {
    background: #f97316;
    color: white;
}

.remove-btn {
    background: #fee2e2;
    color: #b91c1c;
}

.empty-box {
    background: white;
    text-align: center;
    padding: 65px 25px;
    border-radius: 20px;
    color: #777;
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.07);
}

/* Mobile */
@media (max-width: 700px) {
    .favorites-header {
        padding: 18px 16px;
        flex-direction: column;
        gap: 14px;
        text-align: center;
    }

    .favorites-header h2 {
        font-size: 22px;
    }

    .favorites-header a {
        width: 100%;
        text-align: center;
        border-radius: 14px;
    }

    .favorites-container {
        margin: 22px auto;
        padding: 0 14px;
    }

    .favorite-card {
        flex-direction: column;
        align-items: stretch;
        padding: 18px;
        border-radius: 17px;
    }

    .favorite-info h3 {
        font-size: 18px;
        line-height: 1.6;
    }

    .favorite-info p {
        font-size: 13px;
    }

    .favorite-actions {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr;
        gap: 9px;
    }

    .favorite-actions a,
    .favorite-actions button {
        width: 100%;
        text-align: center;
        padding: 12px;
    }

    .empty-box {
        padding: 45px 20px;
    }
}
</style>
</head>

<body>

<div class="favorites-header">
    <h2>⭐ <?php echo e(__('messages.favorites')); ?></h2>
    <a href="<?php echo e(url('/')); ?>"><?php echo e(__('messages.home')); ?></a>
</div>

<div class="favorites-container">

    <?php $__empty_1 = true; $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $item = $favorite->favoritable;
            $type = class_basename($favorite->favoritable_type);
        ?>

        <?php if($item): ?>
            <div class="favorite-card">

                <div class="favorite-info">
                    <span class="favorite-type">
                        <?php if($type == 'Journal'): ?>
                            <?php echo e(__('messages.scientific_journal')); ?>

                        <?php elseif($type == 'LibraryBook'): ?>
                            <?php echo e(__('messages.book')); ?>

                        <?php elseif($type == 'Curriculum'): ?>
                            <?php echo e(__('messages.curriculum_plan')); ?>

                        <?php elseif($type == 'PastExam'): ?>
                            <?php echo e(__('messages.past_exams')); ?>

                        <?php elseif($type == 'EducationalChannel'): ?>
                            <?php echo e(__('messages.educational_channel')); ?>

                        <?php else: ?>
                            <?php echo e(__('messages.digital_content')); ?>

                        <?php endif; ?>
                    </span>

                    <h3><?php echo e($item->title ?? $item->name ?? __('messages.untitled_item')); ?></h3>

                    <?php if(isset($item->issue_number)): ?>
                        <p><?php echo e(__('messages.issue_number')); ?>: <?php echo e($item->issue_number); ?></p>
                    <?php endif; ?>

                    <?php if(isset($item->publication_year)): ?>
                        <p><?php echo e(__('messages.publication_year')); ?>: <?php echo e($item->publication_year); ?></p>
                    <?php endif; ?>

                    <?php if(isset($item->description)): ?>
                        <p><?php echo e($item->description); ?></p>
                    <?php endif; ?>
                </div>

                <div class="favorite-actions">

                    <?php if(isset($item->file_path)): ?>
                        <a class="open-btn" href="<?php echo e(asset('storage/' . $item->file_path)); ?>" target="_blank">
                            <?php echo e(__('messages.open_file')); ?>

                        </a>
                    <?php elseif(isset($item->file)): ?>
                        <a class="open-btn" href="<?php echo e(asset('storage/' . $item->file)); ?>" target="_blank">
                            <?php echo e(__('messages.open_file')); ?>

                        </a>
                    <?php elseif(isset($item->channel_url)): ?>
                        <a class="open-btn" href="<?php echo e($item->channel_url); ?>" target="_blank">
                            <?php echo e(__('messages.open_link')); ?>

                        </a>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('favorites.toggle')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="favoritable_id" value="<?php echo e($favorite->favoritable_id); ?>">
                        <input type="hidden" name="favoritable_type" value="<?php echo e($favorite->favoritable_type); ?>">

                        <button type="submit" class="remove-btn">
                            <?php echo e(__('messages.remove')); ?>

                        </button>
                    </form>

                </div>

            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-box">
            <?php echo e(__('messages.no_favorites')); ?>

        </div>
    <?php endif; ?>

</div>

</body>
</html><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/favorites/index.blade.php ENDPATH**/ ?>