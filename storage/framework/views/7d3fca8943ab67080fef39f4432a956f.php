

<?php $__env->startSection('content'); ?>

<div class="admin-table-page">

    <div class="admin-table-header">

        <h2>إدارة الأدمن</h2>

        <div style="display:flex; gap:10px; align-items:center;">

            

            <form method="GET" class="admin-filter-form">
                <input type="text"
                       name="search"
                       value="<?php echo e(request('search')); ?>"
                       placeholder="بحث بالاسم أو البريد أو رقم القيد">

                <button type="submit" class="admin-add-btn">
                    بحث
                </button>
            </form>

        </div>

    </div>
     <div style="margin-bottom:20px;">
    <a href="<?php echo e(route('admin.users.create')); ?>"
   style="
        background:#e67e22;
        color:white;
        text-decoration:none;
        padding:8px 14px;
        border-radius:8px;
        font-size:13px;
        font-weight:600;
        display:inline-block;
        margin-top:10px;
   ">
    + إضافة مستخدم
</a>
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

        <h3 style="margin-bottom:20px;color:#e67e22;">
            الأدمن
        </h3>

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

                <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>

                        <td><?php echo e($user->name); ?></td>

                        <td><?php echo e($user->email); ?></td>

                        <td>
                            <span class="status-active">
                                Admin
                            </span>
                        </td>

                        <td style="display:flex; gap:8px; justify-content:center;">

                            <form method="POST"
                                  action="<?php echo e(route('admin.admins.updateRole', [$user->id,'student'])); ?>"
                                  onsubmit="return confirm('هل أنت متأكد من إزالة صلاحية الأدمن؟')">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <button class="btn-warning"
                                        <?php echo e($user->id === auth()->id() ? 'disabled' : ''); ?>>
                                    إزالة الأدمن
                                </button>

                            </form>

                            <?php if($user->id !== auth()->id()): ?>
                                <form method="POST"
                                      action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button style="
                                        background:red;
                                        color:white;
                                        border:none;
                                        padding:8px 14px;
                                        border-radius:8px;
                                        cursor:pointer;">
                                        حذف
                                    </button>

                                </form>
                            <?php endif; ?>

                        </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="5" class="empty-table">
                            لا يوجد أدمن حالياً
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

    </div>

    <br><br>

    
    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            البحث عن مستخدم لإضافته كأدمن
        </h3>

        <form method="GET" class="admin-filter-form" style="margin-bottom:20px;">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="بحث بالاسم أو البريد أو رقم القيد">

            <button type="submit" class="admin-add-btn">
                بحث
            </button>

            <?php if(request('search')): ?>
                <a href="<?php echo e(route('admin.admins.index')); ?>"
                   class="btn-warning"
                   style="text-decoration:none; display:inline-block;">
                    إعادة ضبط
                </a>
            <?php endif; ?>
        </form>

        <?php if(request('search')): ?>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم القيد / الرقم الوظيفي</th>
                        <th>الدور الحالي</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>

                            <td><?php echo e($user->name); ?></td>

                            <td><?php echo e($user->email); ?></td>

                            <td><?php echo e($user->student_number ?? '-'); ?></td>

                            <td>
                                <?php if($user->role == 'staff'): ?>
                                    <span class="status-active">
                                        Staff
                                    </span>
                                <?php elseif($user->role == 'student'): ?>
                                    <span class="status-inactive">
                                        Student
                                    </span>
                                <?php else: ?>
                                    <span class="status-inactive">
                                        <?php echo e($user->role); ?>

                                    </span>
                                <?php endif; ?>
                            </td>

                            <td style="display:flex; gap:8px; justify-content:center;">

                                <form method="POST"
                                      action="<?php echo e(route('admin.admins.updateRole', [$user->id,'admin'])); ?>"
                                      onsubmit="return confirm('هل تريد جعل هذا المستخدم أدمن؟')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>

                                    <button class="btn-active">
                                        جعل أدمن
                                    </button>

                                </form>

                                <form method="POST"
                                      action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button style="
                                        background:red;
                                        color:white;
                                        border:none;
                                        padding:8px 14px;
                                        border-radius:8px;
                                        cursor:pointer;">
                                        حذف
                                    </button>

                                </form>

                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="6" class="empty-table">
                                لا توجد نتائج مطابقة
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>

        <?php else: ?>

            <div class="empty-table">
                ابحث عن مستخدم بالاسم أو البريد أو رقم القيد لإضافته كأدمن.
            </div>

        <?php endif; ?>

    </div>

    <br><br>

    
    <div class="admin-table-card">

        <h3 style="margin-bottom:20px;color:#e67e22;">
            آخر النشاطات للأدمن
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