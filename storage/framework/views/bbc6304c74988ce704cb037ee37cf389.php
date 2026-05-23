<?php $__env->startSection('title', 'تسجيل الدخول - مكتبة الجامعة'); ?>

<?php $__env->startSection('form_body'); ?>

<h2>تسجيل الدخول</h2>

<p class="note">
أدخل بريدك الإلكتروني وكلمة المرور للدخول إلى حسابك
</p>

<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>

    <label for="email">البريد الإلكتروني</label>
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

    <label for="password">كلمة المرور</label>
    <input
        id="password"
        type="password"
        name="password"
        placeholder="أدخل كلمة المرور"
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
            تذكرني
        </label>
    </div>

    <?php if(Route::has('password.request')): ?>
        <p style="text-align: center; margin-bottom: 15px;">
            <a href="<?php echo e(route('password.request')); ?>">نسيت كلمة المرور؟</a>
        </p>
    <?php endif; ?>

    <button type="submit" class="login-btn">
        تسجيل الدخول
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    ليس لديك حساب؟
    <a href="<?php echo e(route('register')); ?>">إنشاء حساب</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/login.blade.php ENDPATH**/ ?>