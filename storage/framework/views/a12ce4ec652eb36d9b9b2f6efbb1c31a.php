

<?php $__env->startSection('content'); ?>
<div class="container">

    <h2>إدارة المجلات</h2>

    <a href="<?php echo e(route('admin.journals.create')); ?>" class="btn btn-primary mb-3">
        ➕ إضافة مجلة
    </a>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>السنة</th>
                <th>الناشر</th>
                <th>الملف</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $journals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $journal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($journal->title); ?></td>
                    <td><?php echo e($journal->publication_year); ?></td>
                    <td><?php echo e($journal->publisher); ?></td>

                    <td>
                        <a href="<?php echo e(asset('storage/' . $journal->file_path)); ?>" target="_blank">
                            فتح
                        </a>
                        |
                        <a href="<?php echo e(asset('storage/' . $journal->file_path)); ?>" download>
                            تحميل
                        </a>
                    </td>

                    <td>
                        <form action="<?php echo e(route('admin.journals.destroy', $journal->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/journals/index.blade.php ENDPATH**/ ?>