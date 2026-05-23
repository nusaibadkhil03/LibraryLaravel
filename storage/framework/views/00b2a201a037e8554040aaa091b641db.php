<?php if($items->count()): ?>
    <div class="content-list">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content-row"
                 data-title="<?php echo e($item->title); ?>"
                 data-year="<?php echo e($item->academic_year ?? $item->publication_year ?? $item->year ?? $item->created_at ?? 0); ?>">

                <div class="content-info">
                    <strong><?php echo e($item->title); ?></strong>

                    <p>
                        <?php if(!empty($item->author)): ?>
                            المؤلف: <?php echo e($item->author); ?> |
                        <?php endif; ?>

                        <?php if(!empty($item->academic_year)): ?>
                            السنة: <?php echo e($item->academic_year); ?> |
                        <?php endif; ?>

                        <?php if(!empty($item->doctor_name)): ?>
                            الدكتور: <?php echo e($item->doctor_name); ?> |
                        <?php endif; ?>

                        <?php if(!empty($item->students_names)): ?>
                            الطلبة: <?php echo e($item->students_names); ?> |
                        <?php endif; ?>

                        <?php if(!empty($item->supervisor_name)): ?>
                            المشرف: <?php echo e($item->supervisor_name); ?> |
                        <?php endif; ?>

                        <?php if(!empty($item->semester)): ?>
                            الفصل الدراسي: <?php echo e($item->semester); ?>

                        <?php endif; ?>
                    </p>

                    <?php if(!empty($item->description)): ?>
                        <p><?php echo e(\Illuminate\Support\Str::limit($item->description, 120)); ?></p>
                    <?php endif; ?>
                </div>

                <div class="content-action">
                    <?php
                        $file = $item->file_path ?? null;
                    ?>

                    <?php if($file): ?>
                        <a class="download-btn"
                           href="<?php echo e(asset('storage/' . $file)); ?>"
                           target="_blank">
                            📥 تحميل الملف
                        </a>
                    <?php else: ?>
                        <span class="no-file">لا يوجد ملف PDF</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p class="empty-message"><?php echo e($emptyMessage ?? 'لا يوجد محتوى حالياً.'); ?></p>
<?php endif; ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/departments/partials/file-list.blade.php ENDPATH**/ ?>