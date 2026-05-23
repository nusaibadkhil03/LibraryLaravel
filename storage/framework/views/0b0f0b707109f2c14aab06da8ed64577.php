<?php $__env->startSection('page_title', 'إدارة الأقسام'); ?>

<?php $__env->startSection('content'); ?>
<div class="section-box">

    <h2>إدارة الأقسام</h2>

    <!-- الفورم -->
    <form method="POST" action="<?php echo e(route('admin.departments.store')); ?>" style="margin:20px 0;">
        <?php echo csrf_field(); ?>

        <input type="text" name="name" placeholder="اسم القسم" required
               style="padding:10px; margin:5px;">

        <input type="text" name="description" placeholder="وصف القسم"
               style="padding:10px; margin:5px;">

        <button type="submit" class="admin-logout-btn">إضافة قسم</button>
    </form>
    <?php if(session('success')): ?>
    <div id="success-message"
         style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


    <!-- الجدول -->
    <?php if($departments->count()): ?>
        <table style="width:100%; margin-top:20px; border-collapse: collapse;">
            <thead>
                <tr style="background:#eee;">
                    <th style="padding:10px;">#</th>
                    <th style="padding:10px;">اسم القسم</th>
                    <th style="padding:10px;">الوصف</th>
                    <th style="padding:10px;">الإجراء</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;"><?php echo e($department->id); ?></td>
                        <td style="padding:10px;"><?php echo e($department->name); ?></td>
                       
                        <td style="padding:10px;"><?php echo e($department->description ?? '-'); ?></td>
                    <td>
  

    <!-- زر حذف -->
    <form method="POST"
          action="<?php echo e(route('admin.departments.delete', $department->id)); ?>"
          onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟ سيتم حذفه نهائيًا.');">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <button type="submit"
                style="background:#dc3545; color:white; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">
            حذف
        </button>
    </form>

</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="margin-top:20px;">لا توجد أقسام حالياً.</p>
    <?php endif; ?>

</div>

<script>
    setTimeout(function () {
        let msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 3000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/departments/index.blade.php ENDPATH**/ ?>