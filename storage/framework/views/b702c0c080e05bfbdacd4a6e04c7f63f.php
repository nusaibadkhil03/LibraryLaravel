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

<form method="GET" action="<?php echo e(route('admin.borrows.index')); ?>" style="
    background:#fff;
    padding:18px;
    border-radius:16px;
    margin:20px 0;
    box-shadow:0 4px 14px rgba(0,0,0,0.06);
">

    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap:12px;
        align-items:end;
    ">

        <div>
            <label>بحث</label>
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="اسم الطالب، رقم القيد، الهاتف، الكتاب"
                   style="width:100%;">
        </div>

        <div>
            <label>الحالة</label>
            <select name="status" style="width:100%;">
                <option value="">كل الحالات</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>قيد الانتظار</option>
                <option value="borrowed" <?php echo e(request('status') == 'borrowed' ? 'selected' : ''); ?>>مستعار</option>
                <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>مقبول</option>
                <option value="returned" <?php echo e(request('status') == 'returned' ? 'selected' : ''); ?>>تم الإرجاع</option>
                <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>مرفوض</option>
            </select>
        </div>

        <div>
            <label>تاريخ الاستعارة</label>
            <input type="date"
                   name="borrow_date"
                   value="<?php echo e(request('borrow_date')); ?>"
                   style="width:100%;">
        </div>

        <div>
            <label>تاريخ الإرجاع المتوقع</label>
            <input type="date"
                   name="due_date"
                   value="<?php echo e(request('due_date')); ?>"
                   style="width:100%;">
        </div>

        <div>
            <label>الترتيب</label>
            <select name="sort" style="width:100%;">
                <option value="">الأحدث</option>
                <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>الأقدم</option>
                <option value="student" <?php echo e(request('sort') == 'student' ? 'selected' : ''); ?>>اسم الطالب</option>
                <option value="borrow_date" <?php echo e(request('sort') == 'borrow_date' ? 'selected' : ''); ?>>تاريخ الاستعارة</option>
                <option value="due_date" <?php echo e(request('sort') == 'due_date' ? 'selected' : ''); ?>>تاريخ الإرجاع</option>
            </select>
        </div>

        <div style="display:flex; gap:8px;">
            <button type="submit" style="
                background:#e67e22;
                color:white;
                border:none;
                padding:11px 20px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;
            ">
                تطبيق
            </button>

            <a href="<?php echo e(route('admin.borrows.index')); ?>" style="
                background:#6c757d;
                color:white;
                text-decoration:none;
                padding:11px 20px;
                border-radius:10px;
                font-weight:bold;
            ">
                إعادة ضبط
            </a>
        </div>

    </div>
</form>

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
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>

                <td><?php echo e($borrow->student_name ?? $borrow->user->name ?? '-'); ?></td>

                <td><?php echo e($borrow->user->student_number ?? $borrow->student_number ?? '-'); ?></td>

                <td><?php echo e($borrow->user->department->name ?? '-'); ?></td>

                <td><?php echo e($borrow->user->phone ?? '-'); ?></td>

                <td><?php echo e($borrow->libraryBook->title ?? '-'); ?></td>

                <td><?php echo e($borrow->borrow_date ?? '-'); ?></td>

                <td><?php echo e($borrow->due_date ?? '-'); ?></td>

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

<form method="POST" action="<?php echo e(route('admin.borrows.reject', $borrow->id)); ?>" style="display:flex; gap:6px;">    <?php echo csrf_field(); ?>

    <input type="text"
           name="rejection_reason"
           placeholder="سبب الرفض"
           required
           style="padding:8px; border-radius:8px; border:1px solid #ddd; width:130px;">

    <button type="submit" style="background:red; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer;">
        رفض
    </button>
</form>

                    <?php elseif($borrow->status == 'borrowed' || $borrow->status == 'approved'): ?>

                        <a href="<?php echo e(route('admin.borrows.returnForm', $borrow->id)); ?>"
   style="background:#007bff; color:white; padding:8px 14px; border-radius:8px; text-decoration:none;">
    إرجاع
</a>

                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="10" style="text-align:center; padding:20px;">
                    لا توجد طلبات استعارة حالياً
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/borrows/index.blade.php ENDPATH**/ ?>