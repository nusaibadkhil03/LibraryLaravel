<?php $__env->startSection('title', __('messages.register_page_title')); ?>

<?php $__env->startSection('form_body'); ?>

<h2><?php echo e(__('messages.create_account')); ?></h2>

<p class="note">
    <?php echo e(__('messages.university_email_note')); ?>

</p>

<form method="POST" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?>

    <label for="name"><?php echo e(__('messages.student_name')); ?></label>
    <input
        id="name"
        type="text"
        name="name"
        value="<?php echo e(old('name')); ?>"
        placeholder="<?php echo e(__('messages.full_name')); ?>"
        required
        autofocus
        autocomplete="name"
    >
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="email"><?php echo e(__('messages.university_email')); ?></label>
    <input
        id="email"
        type="email"
        name="email"
        value="<?php echo e(old('email')); ?>"
        placeholder="xxxxxxx@libyanuniv.edu.ly"
        required
        autocomplete="username"
    >
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="student_number"><?php echo e(__('messages.student_number')); ?></label>
    <input
        id="student_number"
        type="text"
        name="student_number"
        value="<?php echo e(old('student_number')); ?>"
        placeholder="<?php echo e(__('messages.enter_student_number')); ?>"
        required
    >
    <?php $__errorArgs = ['student_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="phone"><?php echo e(__('messages.phone_number')); ?></label>
    <input
        id="phone"
        type="text"
        name="phone"
        value="<?php echo e(old('phone')); ?>"
        placeholder="<?php echo e(__('messages.phone_number')); ?>"
        required
    >
    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="department_id"><?php echo e(__('messages.department')); ?></label>
    <select
        id="department_id"
        name="department_id"
        required
        style="width:100%; padding:12px; margin-bottom:18px; border-radius:10px; border:1px solid #ddd;"
    >
        <option value=""><?php echo e(__('messages.select_department')); ?></option>

        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($department->id); ?>"
                <?php echo e(old('department_id') == $department->id ? 'selected' : ''); ?>>
                <?php echo e(app()->getLocale() == 'en'
                    ? ucwords(str_replace('-', ' ', $department->slug))
                    : $department->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="password"><?php echo e(__('messages.password')); ?></label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="<?php echo e(__('messages.password_placeholder')); ?>"
        required
        autocomplete="new-password"
    >
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="password_confirmation"><?php echo e(__('messages.confirm_password')); ?></label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="<?php echo e(__('messages.confirm_password_placeholder')); ?>"
        required
        autocomplete="new-password"
    >
    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color:red; font-size:13px; margin-top:-12px; margin-bottom:15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit" class="login-btn">
        <?php echo e(__('messages.create_account')); ?>

    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    <?php echo e(__('messages.have_account')); ?>

    <a href="<?php echo e(route('login')); ?>">
        <?php echo e(__('messages.login')); ?>

    </a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/register.blade.php ENDPATH**/ ?>