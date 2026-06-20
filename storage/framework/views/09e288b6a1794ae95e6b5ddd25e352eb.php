<?php $__env->startSection('content'); ?>

<div class="curriculum-page">

    <h2 class="curriculum-title">
        <?php echo e(__('messages.curriculum_and_schedules')); ?>

    </h2>

    <form method="GET" action="<?php echo e(route('curriculum')); ?>" class="department-filter">
        <select name="department_id" onchange="this.form.submit()">
            <option value="">
                <?php echo e(__('messages.select_department')); ?>

            </option>

            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->id); ?>"
                    <?php echo e($selectedDepartment == $department->id ? 'selected' : ''); ?>>
                    <?php echo e(app()->getLocale() == 'en'
                        ? ucwords(str_replace('-', ' ', $department->slug))
                        : $department->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

<div class="curriculum-tabs">        <button type="button" class="curriculum-tab-btn active" onclick="showSection('schedules', this)">
            <span>🗓️</span>
            <?php echo e(__('messages.study_schedules')); ?>

        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('plans', this)">
            <span>📘</span>
            <?php echo e(__('messages.study_plan')); ?>

        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('calendars', this)">
            <span>📆</span>
            <?php echo e(__('messages.academic_calendar')); ?>

        </button>

        <button type="button" class="curriculum-tab-btn" onclick="showSection('exams', this)">
            <span>📝</span>
            <?php echo e(__('messages.exam_schedules')); ?>

        </button>
    </div>

    <div id="schedules" class="section-box active">
        <h3 class="section-title">
            <?php echo e(__('messages.study_schedules')); ?>

        </h3>

        <?php if(!$selectedDepartment): ?>
            <p class="empty-msg">
                <?php echo e(__('messages.select_department_for_schedules')); ?>

            </p>
        <?php elseif($schedules->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>"
                             alt="<?php echo e(__('messages.study_schedule')); ?>">

                        <a class="download-btn"
                           href="<?php echo e(asset('storage/' . $item->image)); ?>"
                           download>
                            <?php echo e(__('messages.download_image')); ?>

                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">
                <?php echo e(__('messages.no_schedules_for_department')); ?>

            </p>
        <?php endif; ?>
    </div>

    <div id="plans" class="section-box">
        <h3 class="section-title">
            <?php echo e(__('messages.study_plan')); ?>

        </h3>

        <?php if(!$selectedDepartment): ?>
            <p class="empty-msg">
                <?php echo e(__('messages.select_department_for_plan')); ?>

            </p>
        <?php elseif($plans->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>"
                             alt="<?php echo e(__('messages.study_plan')); ?>">

                        <a class="download-btn"
                           href="<?php echo e(asset('storage/' . $item->image)); ?>"
                           download>
                            <?php echo e(__('messages.download_image')); ?>

                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">
                <?php echo e(__('messages.no_plan_for_department')); ?>

            </p>
        <?php endif; ?>
    </div>

    <div id="calendars" class="section-box">
        <h3 class="section-title">
            <?php echo e(__('messages.academic_calendar')); ?>

        </h3>

        <?php if($calendars->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $calendars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>"
                             alt="<?php echo e(__('messages.academic_calendar')); ?>">

                        <a class="download-btn"
                           href="<?php echo e(asset('storage/' . $item->image)); ?>"
                           download>
                            <?php echo e(__('messages.download_image')); ?>

                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">
                <?php echo e(__('messages.no_academic_calendar')); ?>

            </p>
        <?php endif; ?>
    </div>

    <div id="exams" class="section-box">
        <h3 class="section-title">
            <?php echo e(__('messages.exam_schedules')); ?>

        </h3>

        <?php if(!$selectedDepartment): ?>
            <p class="empty-msg">
                <?php echo e(__('messages.select_department_for_exams')); ?>

            </p>
        <?php elseif($examSchedules->count()): ?>
            <div class="grid-box">
                <?php $__currentLoopData = $examSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="image-card">
                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>"
                             alt="<?php echo e(__('messages.exam_schedule')); ?>">

                        <a class="download-btn"
                           href="<?php echo e(asset('storage/' . $item->image)); ?>"
                           download>
                            <?php echo e(__('messages.download_schedule')); ?>

                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="empty-msg">
                <?php echo e(__('messages.no_exam_schedules_for_department')); ?>

            </p>
        <?php endif; ?>
    </div>

</div>

<script>
    function showSection(sectionId, button) {
        document.querySelectorAll('.curriculum-page .section-box').forEach(section => {
            section.classList.remove('active');
        });

        document.querySelectorAll('.curriculum-tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById(sectionId).classList.add('active');
        button.classList.add('active');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/curriculum/index.blade.php ENDPATH**/ ?>