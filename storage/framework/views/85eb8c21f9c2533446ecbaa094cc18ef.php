

<?php $__env->startSection('content'); ?>

<style>
.admin-table-page { padding:35px !important; direction:rtl !important; }
.admin-table-header { display:flex !important; justify-content:space-between !important; align-items:center !important; margin-bottom:25px !important; }
.admin-add-btn {
    background:#e67e22 !important;
    color:white !important;
    padding:10px 22px !important;
    border-radius:25px !important;
    text-decoration:none !important;
    font-weight:bold !important;
}
.admin-table-card {
    background:#fff !important;
    border-radius:18px !important;
    padding:25px !important;
    box-shadow:0 8px 25px rgba(0,0,0,0.10) !important;
    overflow-x:auto !important;
}
.admin-table { width:100% !important; border-collapse:collapse !important; }
.admin-table th {
    background:#e67e22 !important;
    color:white !important;
    padding:14px !important;
    text-align:center !important;
}
.admin-table td {
    padding:13px !important;
    text-align:center !important;
    border-bottom:1px solid #eee !important;
}
.link-btn {
    display:inline-block !important;
    background:#2c7be5 !important;
    color:white !important;
    padding:8px 14px !important;
    border-radius:20px !important;
    text-decoration:none !important;
    white-space:nowrap !important;
}
.delete-btn {
    background:#dc3545 !important;
    color:white !important;
    border:none !important;
    padding:8px 14px !important;
    border-radius:20px !important;
    cursor:pointer !important;
}
.success-message {
    background:#eaf8ee !important;
    color:#218838 !important;
    padding:12px 18px !important;
    border-radius:12px !important;
    margin-bottom:18px !important;
}
.empty-table { text-align:center !important; color:#999 !important; padding:25px !important; }
</style>

<div class="admin-table-page">

    <div class="admin-table-header">
        <h2>القنوات التعليمية</h2>

        <a href="<?php echo e(route('admin.educational-channels.create')); ?>" class="admin-add-btn">
            + إضافة قناة
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="success-message"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="admin-table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم القناة</th>
                    <th>القسم</th>
                    <th>المنصة</th>
                    <th>الرابط</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department->name ?? '-'); ?></td>
                        <td><?php echo e($item->platform ?? '-'); ?></td>
                        <td>
                            <a href="<?php echo e($item->channel_url); ?>" target="_blank" class="link-btn">
                                فتح الرابط
                            </a>
                        </td>
                        <td>
                            <form action="<?php echo e(route('admin.educational-channels.destroy', $item->id)); ?>"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه القناة؟')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit" class="delete-btn">حذف</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="empty-table">لا توجد قنوات تعليمية حالياً.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/educational-channels/index.blade.php ENDPATH**/ ?>