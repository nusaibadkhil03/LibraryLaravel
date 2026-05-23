

<?php $__env->startSection('content'); ?>

<div class="section-box">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:15px;">
        <h2 style="margin:0; color:#333;">إضافة مجلة جديدة</h2>

        <a href="<?php echo e(route('admin.journals.index')); ?>"
           style="
                background:#6c757d;
                color:white;
                padding:10px 18px;
                border-radius:10px;
                text-decoration:none;
                font-weight:bold;
           ">
            رجوع للمجلات
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div style="
            background:#fdecea;
            color:#842029;
            padding:15px;
            border-radius:12px;
            margin-bottom:20px;
        ">
            <strong>حدث خطأ:</strong>
            <ul style="margin:10px 0 0;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.journals.store')); ?>"
          method="POST"
          enctype="multipart/form-data">

        <?php echo csrf_field(); ?>

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
            gap:20px;
        ">

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    عنوان المجلة
                </label>
                <input type="text"
                       name="title"
                       value="<?php echo e(old('title')); ?>"
                       required
                       placeholder="مثال: مجلة كلية تقنية المعلومات"
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px;">
            </div>

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    الإصدار / العدد
                </label>
                <input type="text"
                       name="issue_number"
                       value="<?php echo e(old('issue_number')); ?>"
                       placeholder="مثال: العدد 5"
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px;">
            </div>

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    سنة النشر
                </label>
                <input type="number"
                       name="publication_year"
                       value="<?php echo e(old('publication_year')); ?>"
                       required
                       placeholder="مثال: 2026"
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px;">
            </div>

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    تاريخ النشر
                </label>
                <input type="date"
                       name="publication_date"
                       value="<?php echo e(old('publication_date')); ?>"
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px;">
            </div>

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    الناشر
                </label>
                <input type="text"
                       name="publisher"
                       value="<?php echo e(old('publisher')); ?>"
                       placeholder="مثال: جامعة مصراتة"
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px;">
            </div>

            <div>
                <label style="font-weight:bold; margin-bottom:8px; display:block;">
                    ملف المجلة PDF
                </label>
                <input type="file"
                       name="file"
                       accept=".pdf"
                       required
                       style="width:100%; padding:11px; border:1px solid #ddd; border-radius:10px; background:white;">
            </div>

        </div>

        <div style="margin-top:20px;">
            <label style="font-weight:bold; margin-bottom:8px; display:block;">
                وصف المجلة
            </label>
            <textarea name="description"
                      rows="5"
                      placeholder="اكتبي وصفًا مختصرًا عن محتوى المجلة..."
                      style="width:100%; padding:12px; border:1px solid #ddd; border-radius:10px; resize:vertical;"><?php echo e(old('description')); ?></textarea>
        </div>

        <div style="margin-top:25px; display:flex; gap:12px; flex-wrap:wrap;">
            <button type="submit"
                    style="
                        background:#e67e22;
                        color:white;
                        border:none;
                        padding:12px 28px;
                        border-radius:12px;
                        font-weight:bold;
                        cursor:pointer;
                    ">
                حفظ المجلة
            </button>

            <a href="<?php echo e(route('admin.journals.index')); ?>"
               style="
                    background:#f1f1f1;
                    color:#333;
                    padding:12px 25px;
                    border-radius:12px;
                    text-decoration:none;
                    font-weight:bold;
               ">
                إلغاء
            </a>
        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/journals/create.blade.php ENDPATH**/ ?>