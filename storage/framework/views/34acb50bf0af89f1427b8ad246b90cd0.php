<?php $__env->startSection('title', __('messages.profile_page_title')); ?>

<?php $__env->startSection('form_body'); ?>

<h2><?php echo e(__('messages.profile')); ?></h2>

<p class="note">
        <?php echo e(__('messages.edit_profile_note')); ?>


</p>

<?php if(session('status') === 'profile-updated'): ?>
    <p style="color: green; text-align: center; margin-bottom: 15px;">
        <?php echo e(__('messages.profile_updated')); ?>

    </p>
<?php endif; ?>

<!-- ✅ البيانات الشخصية -->
<div class="form-section">
    <h3><?php echo e(__('messages.personal_information')); ?></h3>

    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <label><?php echo e(__('messages.student_name')); ?></label>

        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required>

        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="error"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label><?php echo e(__('messages.email')); ?></label>

        <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>

        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="error"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label><?php echo e(__('messages.student_number')); ?></label>

        <input type="text"
               value="<?php echo e($user->student_number ?? __('messages.not_specified')); ?>"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

        <label><?php echo e(__('messages.department')); ?></label>
        <input type="text"
               value="<?php echo e($user->department->name ?? __('messages.not_specified')); ?>"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

<button type="submit" class="login-btn">
    <?php echo e(__('messages.save_changes')); ?>

</button>
    </form>
</div>

<!-- 🔐 تغيير كلمة المرور -->
<div class="form-section">
    <h3><?php echo e(__('messages.change_password')); ?></h3>

    <form method="POST" action="<?php echo e(route('password.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label><?php echo e(__('messages.current_password')); ?></label>
        <input type="password" name="current_password">

        <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="error"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label><?php echo e(__('messages.new_password')); ?></label>
        <input type="password" name="password">

        <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="error"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label><?php echo e(__('messages.confirm_new_password')); ?></label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="login-btn">
            <?php echo e(__('messages.update_password')); ?>

        </button>
    </form>
</div>

<!-- 🗑️ حذف الحساب -->
<div class="form-section">
    <h3 style="color:#c0392b;"><?php echo e(__('messages.delete_account')); ?></h3>

    <p class="note">
    <?php echo e(__('messages.delete_account_warning')); ?>

</p>

    <form method="POST" action="<?php echo e(route('profile.destroy')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

    <label>
       <?php echo e(__('messages.enter_password_to_delete')); ?>

    </label>        <input type="password" name="password" required>

        <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="error"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <button type="submit"
        class="login-btn"
        style="background:#c0392b;">
    <?php echo e(__('messages.delete_account')); ?>

</button>
    </form>
</div>

<p style="text-align:center; margin-top:15px;">
    <a href="<?php echo e(url('/')); ?>">
    <?php echo e(__('messages.back_home')); ?>

</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/profile/edit.blade.php ENDPATH**/ ?>