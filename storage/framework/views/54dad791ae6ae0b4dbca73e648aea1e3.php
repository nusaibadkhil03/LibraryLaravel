<h3 class="content-title"><?php echo e($title); ?></h3>

<?php if($channels->count()): ?>
    <div class="content-list">
        <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content-row">
                <div class="content-info">
                    <strong><?php echo e($channel->title); ?></strong>

                    <p>
                        <?php if($channel->platform): ?>
                            المنصة: <?php echo e($channel->platform); ?>

                        <?php endif; ?>
                    </p>

                    <?php if($channel->description): ?>
                        <p><?php echo e($channel->description); ?></p>
                    <?php endif; ?>
                </div>

                <div class="content-action">
                    <form method="POST"
                          action="<?php echo e(route('favorites.toggle')); ?>"
                          style="display:inline;">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="favoritable_id" value="<?php echo e($channel->id); ?>">
                        <input type="hidden" name="favoritable_type" value="<?php echo e(App\Models\EducationalChannel::class); ?>">

                        <button type="submit" class="favorite-btn" title="إضافة للمفضلة">
                            ⭐
                        </button>
                    </form>

                    <a class="download-btn"
                       href="<?php echo e($channel->channel_url); ?>"
                       target="_blank">
                        فتح القناة
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p class="empty-message"><?php echo e($emptyMessage); ?></p>
<?php endif; ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/departments/partials/channel-list.blade.php ENDPATH**/ ?>