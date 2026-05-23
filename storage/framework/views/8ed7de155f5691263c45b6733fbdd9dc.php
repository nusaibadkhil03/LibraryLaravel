

<?php $__env->startSection('content'); ?>

<h2>إدارة الخطة الدراسية</h2>

<?php if(session('error')): ?>
    <p style="color:red"><?php echo e(session('error')); ?></p>
<?php endif; ?>

<?php if(session('success')): ?>
    <p style="color:green"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<form action="<?php echo e(route('admin.curriculum.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <select name="type" id="type" required>
        <option value="schedule">الجداول الدراسية</option>
        <option value="plan">الخطة الدراسية</option>
        <option value="calendar">التقويم الأكاديمي</option>
        <option value="exam">جدول الامتحانات</option>
    </select>

    <select name="department_id" id="department_id">
        <option value="">اختر القسم</option>
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <input type="file" name="image" required>

    <button type="submit">رفع</button>
</form>

<hr>

<h3>الجداول الدراسية</h3>
<?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div>
        <img src="<?php echo e(asset('storage/'.$item->image)); ?>" width="120">
        <p>القسم: <?php echo e($item->department->name ?? 'غير محدد'); ?></p>

        <form method="POST" action="<?php echo e(route('admin.curriculum.destroy', $item->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit">حذف</button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h3>الخطة الدراسية</h3>
<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div>
        <img src="<?php echo e(asset('storage/'.$item->image)); ?>" width="120">
        <p>القسم: <?php echo e($item->department->name ?? 'غير محدد'); ?></p>

        <form method="POST" action="<?php echo e(route('admin.curriculum.destroy', $item->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit">حذف</button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h3>التقويم الأكاديمي</h3>
<?php $__currentLoopData = $calendars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div>
        <img src="<?php echo e(asset('storage/'.$item->image)); ?>" width="120">

        <form method="POST" action="<?php echo e(route('admin.curriculum.destroy', $item->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit">حذف</button>
        </form>
    </div>

    
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h3>جداول الامتحانات</h3>

<?php $__currentLoopData = $examSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div>
        <img src="<?php echo e(asset('storage/'.$item->image)); ?>" width="120">

        <p>
            القسم:
            <?php echo e($item->department->name ?? 'غير محدد'); ?>

        </p>

        <form method="POST"
              action="<?php echo e(route('admin.curriculum.destroy', $item->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button type="submit">حذف</button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    const typeSelect = document.getElementById('type');
    const departmentSelect = document.getElementById('department_id');

    function toggleDepartment() {
        if (typeSelect.value === 'calendar') {
            departmentSelect.value = '';
            departmentSelect.disabled = true;
        } else {
            departmentSelect.disabled = false;
        }
    }

    typeSelect.addEventListener('change', toggleDepartment);
    toggleDepartment();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/curriculum/index.blade.php ENDPATH**/ ?>