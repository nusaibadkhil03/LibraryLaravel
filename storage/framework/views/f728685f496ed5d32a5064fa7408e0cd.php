

<?php $__env->startSection('content'); ?>

<div class="admin-page">

    <div class="admin-page-header">

        <h2>إدارة الطلبة</h2>

        <form method="GET"
              action="<?php echo e(route('admin.students.index')); ?>"
              class="admin-filter-form">

            <input type="text"
                   name="search"
                   placeholder="بحث باسم الطالب أو البريد..."
                   value="<?php echo e(request('search')); ?>">

            <select name="department_id">
                <option value="">كل الأقسام</option>

                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"
                        <?php echo e(request('department_id') == $department->id ? 'selected' : ''); ?>>
                        <?php echo e($department->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="status">
                <option value="">كل الحالات</option>

                <option value="active"
                    <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>
                    نشط
                </option>

                

                <option value="suspended"
                    <?php echo e(request('status') == 'suspended' ? 'selected' : ''); ?>>
                    موقوف
                </option>
            </select>

            <button type="submit" class="admin-save-btn">
                بحث
            </button>

        </form>

    </div>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="admin-table-card">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>القسم</th>
                    <th>الحالة</th>
                    <th>إدارة الحساب</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($student->id); ?></td>

                        <td><?php echo e($student->name); ?></td>

                        <td><?php echo e($student->email); ?></td>

                        <td>
                            <?php echo e($student->department->name ?? '-'); ?>

                        </td>

                        <td>

                            <?php if($student->status == 'active'): ?>
                                <span class="status-active">
                                    نشط
                                </span>

                            

                            <?php else: ?>
                                <span class="status-suspended">
                                    موقوف
                                </span>
                            <?php endif; ?>

                        </td>

                        <td>

                            <div class="student-actions">

                                <form method="POST"
                                      action="<?php echo e(route('admin.students.updateStatus', [$student->id,'active'])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <button class="btn-active">
                                        تفعيل
                                    </button>
                                </form>

                         

                                <form method="POST"
                                      action="<?php echo e(route('admin.students.updateStatus', [$student->id,'suspended'])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <button class="btn-danger">
                                        إيقاف
                                    </button>
                                </form>

                            </div>

                        </td>

                        <td>

                            <form method="POST"
                                  action="<?php echo e(route('admin.students.destroy',$student->id)); ?>"
                                  onsubmit="return confirm('هل أنت متأكد من حذف الطالب؟')">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button class="btn-danger">
                                    حذف
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="7">
                            لا يوجد طلبة حالياً
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/students/index.blade.php ENDPATH**/ ?>