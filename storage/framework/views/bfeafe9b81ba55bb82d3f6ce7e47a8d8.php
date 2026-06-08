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
            background: #f97316;
            color: white;
            padding: 22px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .favorites-header h2 {
            margin: 0;
            font-size: 26px;
        }

        .favorites-header a {
            background: white;
            color: #f97316;
            text-decoration: none;
            padding: 9px 18px;
            border-radius: 20px;
            font-weight: bold;
        }

        .favorites-container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .favorite-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 8px 22px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }

        .favorite-info h3 {
            margin: 0 0 10px;
            color: #222;
        }

        .favorite-info p {
            margin: 5px 0;
            color: #666;
            line-height: 1.7;
        }

        .favorite-type {
            display: inline-block;
            background: #fff3e8;
            color: #f97316;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 10px;
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
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
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
            padding: 60px;
            border-radius: 18px;
            color: #777;
        }

        @media (max-width: 700px) {
            .favorites-header {
                padding: 18px 20px;
            }

            .favorite-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .favorite-actions {
                width: 100%;
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