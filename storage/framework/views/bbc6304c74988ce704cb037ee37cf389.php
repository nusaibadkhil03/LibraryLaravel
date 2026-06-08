<?php $__env->startSection('title', __('messages.login_page_title')); ?>

<?php $__env->startSection('form_body'); ?>

<h2><?php echo e(__('messages.login')); ?></h2>

<p class="note">
    <?php echo e(__('messages.login_note')); ?>

</p>

<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>

    <label for="email"><?php echo e(__('messages.email')); ?></label>
    <input
        id="email"
        type="email"
        name="email"
        value="<?php echo e(old('email')); ?>"
        placeholder="example@libyanuniv.edu.ly"
        required
        autofocus
        autocomplete="username"
    >
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
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
        autocomplete="current-password"
    >
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div style="margin-bottom: 15px;">
        <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
            <input type="checkbox" name="remember" style="width: auto; margin: 0;">
            <?php echo e(__('messages.remember_me')); ?>

        </label>
    </div>

    <?php if(Route::has('password.request')): ?>
        <p style="text-align: center; margin-bottom: 15px;">
            <a href="<?php echo e(route('password.request')); ?>">
                <?php echo e(__('messages.forgot_password')); ?>

            </a>
        </p>
    <?php endif; ?>

    <button type="submit" class="login-btn">
        <?php echo e(__('messages.login')); ?>

    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    <?php echo e(__('messages.no_account')); ?>

    <a href="<?php echo e(route('register')); ?>">
        <?php echo e(__('messages.create_account')); ?>

    </a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/login.blade.php ENDPATH**/ ?>