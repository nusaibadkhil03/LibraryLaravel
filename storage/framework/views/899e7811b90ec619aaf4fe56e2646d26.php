<?php $__env->startSection('title', 'استعادة كلمة المرور - مكتبة الجامعة'); ?>

<?php $__env->startSection('form_body'); ?>

<h2>استعادة كلمة المرور</h2>

<p class="note">
    أدخل بريدك الجامعي وسنرسل لك رابطًا لإعادة تعيين كلمة المرور.
</p>

<?php if(session('status')): ?>
    <p style="color: green; font-size: 14px; margin-bottom: 15px; text-align:center;">
        <?php echo e(session('status')); ?>

    </p>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('password.email')); ?>">
    <?php echo csrf_field(); ?>

    <label for="email">البريد الجامعي</label>
    <input
        id="email"
        type="email"
        name="email"
        value="<?php echo e(old('email')); ?>"
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

    <button type="submit" class="login-btn">
        إرسال رابط الاستعادة
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    تذكرت كلمة المرور؟
    <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>