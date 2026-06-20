

<?php $__env->startSection('page_title', 'إضافة كتاب'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .book-form {
    margin-top: 20px;
}

.form-section {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 16px;
    padding: 18px;
    margin-bottom: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}

.form-section h3,
.form-section summary {
    font-size: 17px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    cursor: pointer;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 12px;
}

.book-form input,
.book-form select,
.book-form textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: #fafafa;
    font-family: inherit;
}

.book-form textarea {
    margin-top: 12px;
    resize: vertical;
}

.book-form input:focus,
.book-form select:focus,
.book-form textarea:focus {
    outline: none;
    border-color: #e67e22;
    background: #fff;
}
    .section-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }
    .form-section {
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
    }
    .form-section h3 {
        margin-top: 0;
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    .book-form input, .book-form select, .book-form textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    </style>
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

   <form method="POST" action="<?php echo e(route('admin.books.store')); ?>" class="book-form">
    <?php echo csrf_field(); ?>

    <div class="form-section">
        <h3>البيانات الأساسية</h3>

        <div class="form-grid">
            <input type="text" name="title" placeholder="عنوان الكتاب *" required>
            <input type="text" name="author" placeholder="المؤلف">

            <select name="department_id">
                <option value="">اختر القسم</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input type="text" name="book_number" placeholder="رقم الكتاب / التسجيل">
            <input type="number" name="total_copies" placeholder="عدد النسخ *" min="1" required>
            <input type="number" step="0.01" name="price" placeholder="سعر الكتاب">
        </div>
    </div>

    <details class="form-section">
        <summary>بيانات النشر والتصنيف</summary>

        <div class="form-grid">
            <input type="text" name="publisher" placeholder="الناشر">
            <input type="number" name="publication_year" placeholder="سنة النشر">
            <input type="text" name="publication_place" placeholder="مكان النشر">
            <input type="text" name="edition_number" placeholder="رقم الطبعة">
            <input type="text" name="shelf_location" placeholder="مكان الرف">
            <input type="text" name="category_name" placeholder="التصنيف">
            <input type="text" name="department_name" placeholder="قسم / جهة أخرى">
        </div>
    </details>

    <details class="form-section">
        <summary>بيانات السلسلة</summary>

        <div class="form-grid">
            <select name="is_series">
                <option value="0">كتاب مستقل</option>
                <option value="1">تابع لسلسلة</option>
            </select>

            <input type="text" name="series_name" placeholder="اسم السلسلة">
            <input type="number" name="series_parts_count" placeholder="عدد أجزاء السلسلة">
            <input type="number" name="part_number" placeholder="رقم هذا الجزء">
        </div>
    </details>

    <details class="form-section">
        <summary>الوصف وسياسة الفقدان</summary>

        <textarea name="description" rows="3" placeholder="وصف مختصر للكتاب"></textarea>

        <textarea name="loss_policy" rows="3" placeholder="سياسة الفقدان">
في حالة فقدان الكتاب يلتزم الطالب بإحضار نسخة بديلة من نفس الكتاب، أو دفع خمسة أضعاف سعر الكتاب. وفي حال كان الكتاب جزءًا من سلسلة كاملة يلتزم الطالب بدفع قيمة السلسلة كاملة.
        </textarea>
    </details>

    <button type="submit" class="admin-logout-btn">إضافة كتاب</button>
</form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/books/create.blade.php ENDPATH**/ ?>