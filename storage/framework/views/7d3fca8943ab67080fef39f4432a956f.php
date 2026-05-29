

<?php $__env->startSection('content'); ?>

<div class="admin-table-page">

    <div class="admin-table-header">
        <h2>إدارة الأدمن</h2>

        <form method="GET" class="admin-filter-form">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="بحث بالاسم أو البريد">

            <button type="submit" class="admin-add-btn">
                بحث
            </button>
        </form>
    </div>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="error-message">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="admin-table-card">

        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الدور الحالي</th>
                    <th>الإجراء</th>
                </tr>
            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($user->id); ?></td>

                        <td><?php echo e($user->name); ?></td>

                        <td><?php echo e($user->email); ?></td>

                        <td>
                            <?php if($user->role == 'admin'): ?>
                                <span class="status-active">
                                    Admin
                                </span>
                            <?php else: ?>
                                <span class="status-inactive">
                                    Student
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>

                            <?php if($user->role == 'admin'): ?>

                                <form method="POST"
                                      action="<?php echo e(route('admin.admins.updateRole', [$user->id,'student'])); ?>">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <button class="btn-warning">
                                        إزالة الأدمن
                                    </button>

                                </form>

                            <?php else: ?>

                                <form method="POST"
                                      action="<?php echo e(route('admin.admins.updateRole', [$user->id,'admin'])); ?>">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <button class="btn-active">
                                        جعل أدمن
                                    </button>

                                </form>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="5" class="empty-table">
                            لا يوجد مستخدمون
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <br><br>

    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            آخر  النشاطات للأدمن
        </h3>

        <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div style="
                padding:12px;
                border-bottom:1px solid #eee;
                display:flex;
                justify-content:space-between;
                align-items:center;
            ">

                <div>

                    <strong>
                        <?php echo e($activity->admin->name ?? 'غير معروف'); ?>

                    </strong>

                    <br>

                    <?php echo e($activity->description); ?>


                </div>

                <small style="color:#888;">
                    <?php echo e($activity->created_at->diffForHumans()); ?>

                </small>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="empty-table">
                لا توجد نشاطات حتى الآن
            </div>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/admins/index.blade.php ENDPATH**/ ?>