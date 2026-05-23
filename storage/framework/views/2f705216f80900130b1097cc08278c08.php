<?php $__env->startSection('title', 'إنشاء حساب - مكتبة الجامعة'); ?>

<?php $__env->startSection('form_body'); ?>

<h2>إنشاء حساب</h2>

<p class="note">
ملاحظة: يجب استخدام البريد الجامعي
</p>

<form method="POST" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?>

    <label for="name">اسم الطالب</label>
    <input
        id="name"
        type="text"
        name="name"
        value="<?php echo e(old('name')); ?>"
        placeholder="الاسم الكامل"
        required
        autofocus
        autocomplete="name"
    >
    <?php $__errorArgs = ['name'];
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

    <label for="email">البريد الجامعي</label>
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
        <p style="color: red; font-size: 13px; margin-top: -12px; margin-bottom: 15px;">
            <?php echo e($message); ?>

        </p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="student_number">رقم القيد</label>
<input
    id="student_number"
    type="text"
    name="student_number"
    value="<?php echo e(old('student_number')); ?>"
    placeholder="أدخل رقم القيد"
    required
>
<?php $__errorArgs = ['student_number'];
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

<label for="department_id">القسم</label>
<select
    id="department_id"
    name="department_id"
    required
    style="width:100%; padding:12px; margin-bottom:18px; border-radius:10px; border:1px solid #ddd;"
>
    <option value="">اختر القسم</option>

    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($department->id); ?>"
            <?php echo e(old('department_id') == $department->id ? 'selected' : ''); ?>>
            <?php echo e($department->name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php $__errorArgs = ['department_id'];
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

    <label for="password_confirmation">إعادة كلمة المرور</label>
    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        placeholder="أعد كتابة كلمة المرور"
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
        إنشاء حساب
    </button>
</form>

<p style="text-align:center; margin-top:15px;">
    لديك حساب بالفعل؟
    <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/auth/register.blade.php ENDPATH**/ ?>