

<?php $__env->startSection('page_title', 'إضافة كتاب'); ?>

<?php $__env->startSection('content'); ?>

<div class="section-box">

    <h2>إضافة كتاب جديد</h2>
    <div style="margin:20px 0;">

    <a href="<?php echo e(route('admin.books.index')); ?>">

        <button style="
            background:#6c757d;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            cursor:pointer;
        ">
            عرض الكتب
        </button>

    </a>

</div>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

   <form method="POST" action="<?php echo e(route('admin.books.store')); ?>" style="margin:20px 0;">
        <?php echo csrf_field(); ?>

        <input type="text" name="title" placeholder="عنوان الكتاب" required style="padding:10px; margin:5px;">

        <input type="text" name="author" placeholder="المؤلف" style="padding:10px; margin:5px;">

        <input type="text" name="publisher" placeholder="الناشر" style="padding:10px; margin:5px;">

        <input type="number" name="publication_year" placeholder="سنة النشر" style="padding:10px; margin:5px;">

        <input type="text" name="publication_place" placeholder="مكان النشر" style="padding:10px; margin:5px;">

        <input type="text" name="book_number" placeholder="رقم الكتاب / التسجيل" style="padding:10px; margin:5px;">

        <input type="text" name="edition_number" placeholder="رقم الطبعة" style="padding:10px; margin:5px;">

        <input type="text" name="shelf_location" placeholder="مكان الرف" style="padding:10px; margin:5px;">

        <select name="department_id" required style="padding:10px; margin:5px;">
            <option value="">اختر القسم</option>

            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->id); ?>">
                    <?php echo e($department->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <input type="number"
               name="total_copies"
               placeholder="عدد النسخ"
               required
               min="1"
               style="padding:10px; margin:5px;">

        <button type="submit" class="admin-logout-btn">
            إضافة كتاب
        </button>
    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/books/create.blade.php ENDPATH**/ ?>