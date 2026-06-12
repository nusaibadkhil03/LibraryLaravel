<?php if($items->count()): ?>
    <div class="content-list">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $modelClass = get_class($item);
                $file = $item->file_path ?? null;
            ?>

            <div class="content-row"
                 data-title="<?php echo e($item->title); ?>"
                 data-year="<?php echo e($item->academic_year ?? $item->publication_year ?? $item->year ?? $item->created_at ?? 0); ?>">

                <div class="content-info">

                    <strong class="content-main-title">
                        <?php echo e($item->title); ?>

                    </strong>

                    <div class="content-meta">

                        <?php if(!empty($item->exam_year)): ?>
                            <span><?php echo e(__('messages.exam_year')); ?>: <?php echo e($item->exam_year); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->academic_year)): ?>
                            <span><?php echo e(__('messages.academic_year')); ?>: <?php echo e($item->academic_year); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->author)): ?>
                            <span><?php echo e(__('messages.author')); ?>: <?php echo e($item->author); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->lecture_number)): ?>
                            <span><?php echo e(__('messages.lecture')); ?>: <?php echo e($item->lecture_number); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->doctor_name)): ?>
                            <span><?php echo e(__('messages.doctor')); ?>: <?php echo e($item->doctor_name); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->students_names)): ?>
                            <span><?php echo e(__('messages.students')); ?>: <?php echo e($item->students_names); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->supervisor_name)): ?>
                            <span><?php echo e(__('messages.supervisor')); ?>: <?php echo e($item->supervisor_name); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($item->semester)): ?>
                            <span><?php echo e(__('messages.semester')); ?>: <?php echo e($item->semester); ?></span>
                        <?php endif; ?>

                    </div>

                    <?php if(!empty($item->description)): ?>
                        <p class="content-description">
                            <?php echo e(\Illuminate\Support\Str::limit($item->description, 120)); ?>

                        </p>
                    <?php endif; ?>

                    <div class="content-action">

                        <?php if($file): ?>

                            <?php if(isset($title) && str_contains($title, 'مشاريع')): ?>

                                <a class="download-btn"
                                   href="<?php echo e(asset('storage/' . $file)); ?>"
                                   target="_blank">
                                    👁️ <?php echo e(__('messages.read_project')); ?>

                                </a>

                            <?php else: ?>

                                <a class="download-btn"
                                   href="<?php echo e(asset('storage/' . $file)); ?>"
                                   target="_blank">
                                    📥 <?php echo e(__('messages.download_file')); ?>

                                </a>

                            <?php endif; ?>

                        <?php else: ?>

                            <span class="no-file"><?php echo e(__('messages.no_file')); ?></span>

                        <?php endif; ?>

                        <form method="POST"
                              action="<?php echo e(route('favorites.toggle')); ?>"
                              style="display:inline;">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="favoritable_id" value="<?php echo e($item->id); ?>">
                            <input type="hidden" name="favoritable_type" value="<?php echo e($modelClass); ?>">

                            <button type="submit"
                                    class="favorite-btn"
                                    title="<?php echo e(__('messages.add_to_favorites')); ?>">
                                ⭐
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p class="empty-message">
        <?php echo e($emptyMessage ?? __('messages.no_content_currently')); ?>

    </p>
<?php endif; ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/departments/partials/file-list.blade.php ENDPATH**/ ?>