<?php $__env->startSection('title', 'الملف الشخصي - مكتبة الجامعة'); ?>

<?php $__env->startSection('form_body'); ?>

<h2>الملف الشخصي</h2>

<p class="note">
يمكنك تعديل بياناتك الشخصية من هنا
</p>

<?php if(session('status') === 'profile-updated'): ?>
    <p style="color: green; text-align: center; margin-bottom: 15px;">
        تم تحديث البيانات بنجاح
    </p>
<?php endif; ?>

<!-- ✅ البيانات الشخصية -->
<div class="form-section">
    <h3>البيانات الشخصية</h3>

    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <label>اسم الطالب</label>
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

        <label>البريد الإلكتروني</label>
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

        <label>رقم القيد</label>
        <input type="text"
               value="<?php echo e($user->student_number ?? 'غير محدد'); ?>"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

        <label>القسم</label>
        <input type="text"
               value="<?php echo e($user->department->name ?? 'غير محدد'); ?>"
               readonly
               style="background:#f8f8f8; cursor:not-allowed;">

        <button type="submit" class="login-btn">حفظ التعديلات</button>
    </form>
</div>

<!-- 🔐 تغيير كلمة المرور -->
<div class="form-section">
    <h3>تغيير كلمة المرور</h3>

    <form method="POST" action="<?php echo e(route('password.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label>كلمة المرور الحالية</label>
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

        <label>كلمة المرور الجديدة</label>
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

        <label>تأكيد كلمة المرور الجديدة</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="login-btn">تحديث كلمة المرور</button>
    </form>
</div>

<!-- 🗑️ حذف الحساب -->
<div class="form-section">
    <h3 style="color:#c0392b;">حذف الحساب</h3>

    <p class="note">
        عند حذف الحساب سيتم حذف جميع البيانات المرتبطة به نهائيًا.
    </p>

    <form method="POST" action="<?php echo e(route('profile.destroy')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <label>أدخل كلمة المرور لتأكيد الحذف</label>
        <input type="password" name="password" required>

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

        <button type="submit" class="login-btn" style="background:#c0392b;">
            حذف الحساب
        </button>
    </form>
</div>

<p style="text-align:center; margin-top:15px;">
    <a href="<?php echo e(url('/')); ?>">الرجوع إلى الصفحة الرئيسية</a>
</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.form_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/profile/edit.blade.php ENDPATH**/ ?>