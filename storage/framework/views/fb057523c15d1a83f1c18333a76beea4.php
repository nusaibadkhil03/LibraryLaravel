<?php $__env->startSection('title', 'إعادة تعيين كلمة المرور - مكتبة الجامعة'); ?>

<?php $__env->startSection('form_body'); ?>

<h2>إعادة تعيين كلمة المرور</h2>

<p class="note">
    أدخل كلمة المرور الجديدة لحسابك.
</p>

<form method="POST" action="<?php echo e(route('password.store')); ?>">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">

    <label for="email">البريد الجامعي</label>
    <input
        id="email"
        type="email"
        name="email"
        value="<?php echo e(old('email', $request->email)); ?>"
        placeholder="xxxxxxx@libyanuniv.edu.ly"
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

    <label for="password">كلمة المرور الجديدة</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="أدخل كلمة المرور الجديدة"
        required
        autocomplete="new-password"
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

    <label for="password_confirmation">تأكيد كلمة المرور</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="أعد كتابة كلمة المرور الجديدة"
        required
        autocomplete="new-password"
    >
    <?php $__errorArgs = ['password_confirmation'];
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

    <button type="submit" class="login-btn">
        حفظ كلمة المرور الجديدة
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    تذكرت كلمة المرور؟
    <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>