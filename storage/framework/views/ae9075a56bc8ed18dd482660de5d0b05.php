<?php $__env->startSection('content'); ?>
<style>
.admin-form-page {
    padding: 35px !important;
    direction: rtl !important;
}

.admin-form-card {
    background: #fff !important;
    max-width: 850px !important;
    padding: 30px !important;
    border-radius: 18px !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
}

.admin-form-grid {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 22px !important;
}

.admin-field {
    display: flex !important;
    flex-direction: column !important;
}

.admin-field.full {
    grid-column: span 2 !important;
}

.admin-field input,
.admin-field select,
.admin-field textarea {
    border: 1px solid #ddd !important;
    border-radius: 12px !important;
    padding: 12px 15px !important;
    background: #fafafa !important;
}

.admin-save-btn {
    background: #e67e22 !important;
    color: white !important;
    border: none !important;
    padding: 12px 35px !important;
    border-radius: 25px !important;
}
.admin-back-btn {
    display: inline-block !important;
    background: #fff !important;
    color: #e67e22 !important;
    border: 1px solid #e67e22 !important;
    padding: 10px 22px !important;
    border-radius: 25px !important;
    text-decoration: none !important;
    font-weight: bold !important;
    transition: 0.3s !important;
}

.admin-back-btn:hover {
    background: #e67e22 !important;
    color: #fff !important;
}
</style>

<div class="admin-form-page">

    <div class="admin-form-header">
        <h2>إضافة منهج جديد</h2>

        <a href="<?php echo e(route('admin.syllabuses.index')); ?>" class="admin-back-btn">
    ← رجوع إلى المناهج
</a>
    </div>

    <div class="admin-form-card">
        <form action="<?php echo e(route('admin.syllabuses.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="admin-form-grid">

                <div class="admin-field">
                    <label>عنوان المنهج</label>
                    <input type="text" name="title" required>
                </div>

                <div class="admin-field">
                    <label>القسم</label>
                    <select name="department_id" required>
                        <option value="">اختر القسم</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="admin-field">
                    <label>السنة الدراسية</label>
                    <input type="text" name="academic_year" placeholder="مثال: 2025-2026">
                </div>

                <div class="admin-field">
                    <label>الفصل الدراسي</label>
                    <select name="semester">
                        <option value="">اختر الفصل</option>
                        <option value="fall">خريف</option>
                        <option value="spring">ربيع</option>
                        <option value="summer">صيف</option>
                    </select>
                </div>

                <div class="admin-field full">
                    <label>الوصف</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div class="admin-field full">
                    <label>ملف المنهج PDF</label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx" required>
                </div>

            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-save-btn">
                    حفظ المنهج
                </button>
            </div>
        </form>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/syllabuses/create.blade.php ENDPATH**/ ?>