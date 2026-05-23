

<?php $__env->startSection('content'); ?>

<div class="section-box">

    <h2>مشاريع التخرج</h2>

    <a href="<?php echo e(route('admin.projects.create')); ?>" class="admin-logout-btn">
        إضافة مشروع
    </a>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($projects->count()): ?>
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المشروع</th>
                    <th>القسم</th>
                    <th>الطلبة</th>
                    <th>المشرف</th>
                    <th>الفصل</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department->name ?? '-'); ?></td>
                        <td><?php echo e($item->students_names); ?></td>
                        <td><?php echo e($item->supervisor_name); ?></td>
                        <td><?php echo e($item->semester); ?></td>

                        <td>
                            <?php if($item->file_path): ?>
                                <a href="<?php echo e(asset('storage/'.$item->file_path)); ?>" target="_blank">
                                    عرض
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>

                        <td>
                            <form action="<?php echo e(route('admin.projects.destroy', $item->id)); ?>"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>لا توجد مشاريع حالياً</p>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/projects/index.blade.php ENDPATH**/ ?>