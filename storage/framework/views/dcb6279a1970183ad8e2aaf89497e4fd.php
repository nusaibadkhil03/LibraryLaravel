

<?php $__env->startSection('content'); ?>

<style>
.digital-form-card {
    max-width: 850px;
    margin: 30px auto;
    background: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.digital-form-title {
    color: #e67e22;
    margin-bottom: 20px;
    text-align: right;
}

.digital-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.digital-field {
    display: flex;
    flex-direction: column;
}

.digital-field.full {
    grid-column: span 2;
}

.digital-field label {
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.digital-field input,
.digital-field select,
.digital-field textarea {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 12px 14px;
    font-size: 15px;
    background: #fafafa;
    box-sizing: border-box;
}

.digital-field input:focus,
.digital-field select:focus,
.digital-field textarea:focus {
    outline: none;
    border-color: #e67e22;
    background: #fff;
}

.form-actions {
    margin-top: 25px;
    display: flex;
    gap: 12px;
    justify-content: flex-start;
}

.btn-orange {
    background: #e67e22;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
}

.btn-gray {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: bold;
}
</style>

<div class="digital-form-card">

    <h2 class="digital-form-title">إضافة كتاب رقمي PDF</h2>

    <form method="POST"
          action="<?php echo e(route('admin.digital-books.store')); ?>"
          enctype="multipart/form-data">

        <?php echo csrf_field(); ?>

        <div class="digital-form-grid">

            <div class="digital-field">
                <label>اسم الكتاب</label>
                <input type="text" name="title" required>
            </div>

            <div class="digital-field">
                <label>المؤلف</label>
                <input type="text" name="author">
            </div>

            <div class="digital-field">
                <label>القسم</label>
                <select name="department_id" required>
                    <option value="">اختر القسم</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="digital-field">
                <label>الفصل الدراسي</label>
                <input type="text" name="semester" placeholder="مثال: خريف 2025">
            </div>

            <div class="digital-field full">
                <label>ملف PDF</label>
                <input type="file" name="file" accept="application/pdf" required>
            </div>

            <div class="digital-field full">
                <label>وصف الكتاب</label>
                <textarea name="description" rows="5"></textarea>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn-orange">
                رفع كتاب PDF
            </button>

            <a href="<?php echo e(route('admin.digital-books.index')); ?>">
                <button type="button" class="btn-gray">
                    عرض الكتب الرقمية
                </button>
            </a>
        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/digital-books/create.blade.php ENDPATH**/ ?>