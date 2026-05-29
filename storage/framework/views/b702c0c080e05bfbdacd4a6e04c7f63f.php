app/Http/Controllers/Admin/AdminBorrowController.php


<?php $__env->startSection('content'); ?>

<h2>طلبات الاستعارة</h2>

<?php if(session('success')): ?>
    <div style="background:#d4edda; padding:10px; margin-bottom:10px; border-radius:8px;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div style="background:#f8d7da; padding:10px; margin-bottom:10px; border-radius:8px;">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#eee;">
            <th>#</th>
            <th>اسم الطالب</th>
            <th>رقم القيد</th>
            <th>القسم</th>
            <th>رقم الهاتف</th>
            <th>الكتاب</th>
            <th>تاريخ الاستعارة</th>
            <th>تاريخ الإرجاع المتوقع</th>
            <th>العدد الكلي</th>
            <th>النسخ المتاحة</th>
            <th>النسخ المستعارة</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($borrow->id); ?></td>

                <td><?php echo e($borrow->student_name ?? $borrow->user->name ?? '-'); ?></td>

                <td><?php echo e($borrow->user->student_number ?? $borrow->student_number ?? '-'); ?></td>

                <td><?php echo e($borrow->user->department->name ?? '-'); ?></td>

                <td><?php echo e($borrow->user->phone ?? '-'); ?></td>

                <td><?php echo e($borrow->libraryBook->title ?? '-'); ?></td>

                <td><?php echo e($borrow->borrow_date ?? '-'); ?></td>

                <td><?php echo e($borrow->due_date ?? '-'); ?></td>

                <td><?php echo e($borrow->libraryBook->total_copies ?? '-'); ?></td>

                <td><?php echo e($borrow->libraryBook->available_copies ?? '-'); ?></td>

                <td>
                    <?php echo e(($borrow->libraryBook->total_copies ?? 0)
                        -
                        ($borrow->libraryBook->available_copies ?? 0)); ?>

                </td>

                <td>
                    <?php if($borrow->status == 'pending'): ?>
                        قيد الانتظار
                    <?php elseif($borrow->status == 'borrowed'): ?>
                        مستعار
                    <?php elseif($borrow->status == 'returned'): ?>
                        تم الإرجاع
                    <?php elseif($borrow->status == 'rejected'): ?>
                        مرفوض
                    <?php elseif($borrow->status == 'approved'): ?>
                        مقبول
                    <?php else: ?>
                        <?php echo e($borrow->status); ?>

                    <?php endif; ?>
                </td>

                <td style="padding:10px; display:flex; gap:8px; justify-content:center;">
                    <?php if($borrow->status == 'pending'): ?>

                        <form method="POST" action="<?php echo e(route('admin.borrows.approve', $borrow->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background:green; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                قبول
                            </button>
                        </form>

                        <form method="POST" action="<?php echo e(route('admin.borrows.reject', $borrow->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background:red; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                رفض
                            </button>
                        </form>

                    <?php elseif($borrow->status == 'borrowed' || $borrow->status == 'approved'): ?>

                        <form method="POST" action="<?php echo e(route('admin.borrows.return', $borrow->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
                                إرجاع
                            </button>
                        </form>

                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="13" style="text-align:center; padding:20px;">
                    لا توجد طلبات استعارة حالياً
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/borrows/index.blade.php ENDPATH**/ ?>