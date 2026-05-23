

<?php $__env->startSection('content'); ?>

<div class="section-box">

    <h2>أسئلة السنوات</h2>

    <a href="<?php echo e(route('admin.past-exams.create')); ?>" class="admin-logout-btn">
        إضافة جديد
    </a>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($pastExams->count()): ?>
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>القسم</th>
                    <th>السنة</th>
                    <th>الفصل</th>
                    <th>الدكتور</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $pastExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department->name ?? '-'); ?></td>
                        <td><?php echo e($item->academic_year); ?></td>
                        <td><?php echo e($item->semester); ?></td>
                        <td><?php echo e($item->doctor_name); ?></td>

                        <td>
                            <a href="<?php echo e(asset('storage/'.$item->file_path)); ?>" target="_blank">
                                عرض
                            </a>
                        </td>

                        <td>
                            <form action="<?php echo e(route('admin.past-exams.destroy', $item->id)); ?>"
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
        <p>لا توجد بيانات</p>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/past-exams/index.blade.php ENDPATH**/ ?>