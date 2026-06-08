<?php $__env->startSection('content'); ?>

<div class="curriculum-page">

    <h2 class="curriculum-title">الخطة الدراسية والجداول</h2>

    <form method="GET" action="<?php echo e(route('curriculum')); ?>" class="department-filter">
        <select name="department_id" onchange="this.form.submit()">
            <option value="">اختر القسم</option>

            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->id); ?>"
                    <?php echo e($selectedDepartment == $department->id ? 'selected' : ''); ?>>
                    <?php echo e($department->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

    <div class="tabs">
        <button type="button" class="tab-btn active" onclick="showSection('schedules', this)">
            <span>🗓️</span>
            الجداول الدراسية
        </button>

        <button type="button" class="tab-btn" onclick="showSection('plans', this)">
            <span>📘</span>
            الخطة الدراسية
        </button>

        <button type="button" class="tab-btn" onclick="showSection('calendars', this)">
            <span>📆</span>
            التقويم الأكاديمي
        </button>
        <button type="button" class="tab-btn" onclick="showSection('exams', this)">
            <span>📝</span>
             جدول الامتحانات
            </button>
    </div>

    <div id="schedules" class="section-box active">
        <h3 class="section-title">الجداول الدراسية</h3>

        <?php if(!$selectedDepartment): ?>
            <p class="empty-msg">يرجى اختيار القسم لعرض الجداول الدراسية.</p>
        <?php elseif($schedules->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="جدول دراسي">
                        <a class="download-btn" href="<?php echo e(asset('storage/' . $item->image)); ?>" download>
                            تحميل الصورة
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">لا توجد جداول دراسية لهذا القسم حالياً.</p>
        <?php endif; ?>
    </div>

    <div id="plans" class="section-box">
        <h3 class="section-title">الخطة الدراسية</h3>

        <?php if(!$selectedDepartment): ?>
            <p class="empty-msg">يرجى اختيار القسم لعرض الخطة الدراسية.</p>
        <?php elseif($plans->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="خطة دراسية">
                        <a class="download-btn" href="<?php echo e(asset('storage/' . $item->image)); ?>" download>
                            تحميل الصورة
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">لا توجد خطة دراسية لهذا القسم حالياً.</p>
        <?php endif; ?>
    </div>

    <div id="calendars" class="section-box">
        <h3 class="section-title">التقويم الأكاديمي</h3>

        <?php if($calendars->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $calendars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="التقويم الأكاديمي">
                        <a class="download-btn" href="<?php echo e(asset('storage/' . $item->image)); ?>" download>
                            تحميل الصورة
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">لا يوجد تقويم أكاديمي حالياً.</p>
        <?php endif; ?>
    </div>
    <div id="exams" class="section-box">
    <h3 class="section-title">جداول الامتحانات</h3>

    <?php if(!$selectedDepartment): ?>
        <p class="empty-msg">يرجى اختيار القسم لعرض جداول الامتحانات.</p>

    <?php elseif($examSchedules->count()): ?>
        <div class="grid-box">
            <?php $__currentLoopData = $examSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="image-card">
                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="جدول امتحانات">

                    <a class="download-btn"
                       href="<?php echo e(asset('storage/' . $item->image)); ?>"
                       download>
                        تحميل الجدول
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    <?php else: ?>
        <p class="empty-msg">لا توجد جداول امتحانات لهذا القسم حالياً.</p>
    <?php endif; ?>
</div>

</div>

<script>
    function showSection(sectionId, button) {
        document.querySelectorAll('.section-box').forEach(section => {
            section.classList.remove('active');
        });

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById(sectionId).classList.add('active');
        button.classList.add('active');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/curriculum/index.blade.php ENDPATH**/ ?>