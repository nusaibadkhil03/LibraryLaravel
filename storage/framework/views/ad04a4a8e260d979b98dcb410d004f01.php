

<?php $__env->startSection('page_title', 'تأكيد إرجاع الكتاب'); ?>

<?php $__env->startSection('content'); ?>

<div class="section-box">

    <h2>تأكيد إرجاع الكتاب</h2>

    <div style="background:#fff; padding:20px; border-radius:16px; margin-bottom:20px; box-shadow:0 4px 14px rgba(0,0,0,0.08); line-height:1.9;">
        <p><strong>اسم الطالب:</strong> <?php echo e($borrow->student_name ?? $borrow->user->name ?? '-'); ?></p>
        <p><strong>رقم القيد:</strong> <?php echo e($borrow->student_number ?? $borrow->user->student_number ?? '-'); ?></p>
        <p><strong>اسم الكتاب:</strong> <?php echo e($borrow->libraryBook->title ?? '-'); ?></p>
        <p><strong>سعر الكتاب:</strong> <?php echo e($borrow->libraryBook->price ?? 0); ?> د.ل</p>
        <p><strong>تاريخ الإرجاع المتوقع:</strong> <?php echo e($borrow->due_date ?? '-'); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('admin.borrows.return', $borrow->id)); ?>">
        <?php echo csrf_field(); ?>

        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px;">

            <div>
                <label>تاريخ الإرجاع الفعلي</label>
                <input type="date"
                       name="actual_return_date"
                       value="<?php echo e(date('Y-m-d')); ?>"
                       required
                       style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
            </div>

            <div>
                <label>حالة الكتاب</label>
                <select name="return_status"
                        id="return_status"
                        required
                        style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
                    <option value="returned">تم إرجاع الكتاب</option>
                    <option value="lost">الكتاب مفقود</option>
                </select>
            </div>

            <div>
                <label>قيمة الغرامة</label>
                <input type="number"
                       name="fine_amount"
                       id="fine_amount"
                       value="0"
                       min="0"
                       step="0.01"
                       style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:8px; margin-top:34px;">
                    <input type="checkbox" name="is_late" value="1">
                    يوجد تأخير في الإرجاع
                </label>
            </div>

            <div>
                <label style="display:flex; align-items:center; gap:8px; margin-top:12px;">
                    <input type="checkbox" name="fine_paid" value="1">
                    تم دفع الغرامة
                </label>
            </div>

            <div id="lost_book_box"
                 style="display:none; grid-column:span 2; background:#fff7ed; border:1px solid #fed7aa; padding:18px; border-radius:14px;">

                <h3 style="margin-top:0; color:#c2410c;">إجراءات ضياع الكتاب</h3>

                <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:18px;">

                    <div>
                        <label>طريقة التعويض</label>
                        <select name="loss_compensation_type"
                                id="loss_compensation_type"
                                style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
                            <option value="">اختر طريقة التعويض</option>
                            <option value="replacement">إحضار نسخة بديلة</option>
                            <option value="pay_five_times">دفع 5 أضعاف سعر الكتاب</option>
                            <option value="pay_series">دفع قيمة السلسلة كاملة</option>
                        </select>
                    </div>

                    <div>
                        <label>قيمة التعويض</label>
                        <input type="number"
                               name="loss_compensation_amount"
                               id="loss_compensation_amount"
                               value="0"
                               min="0"
                               step="0.01"
                               style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;">
                    </div>

                    <div style="grid-column:span 2;">
                        <label>ملاحظات الضياع</label>
                        <textarea name="loss_notes"
                                  rows="3"
                                  placeholder="مثال: الطالب أحضر نسخة بديلة / تم دفع قيمة التعويض..."
                                  style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;"></textarea>
                    </div>

                </div>
            </div>

            <div style="grid-column:span 2;">
                <label>ملاحظات الإرجاع</label>
                <textarea name="return_notes"
                          rows="4"
                          placeholder="اكتب أي ملاحظات عن حالة الكتاب أو الغرامة..."
                          style="width:100%; padding:12px; border-radius:10px; border:1px solid #ddd;"></textarea>
            </div>

        </div>

        <div style="margin-top:25px; display:flex; gap:10px;">
            <button type="submit" style="
                background:#007bff;
                color:white;
                border:none;
                padding:12px 25px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;">
                تأكيد الإرجاع
            </button>

            <a href="<?php echo e(route('admin.borrows.index')); ?>" style="
                background:#6c757d;
                color:white;
                text-decoration:none;
                padding:12px 25px;
                border-radius:10px;
                font-weight:bold;">
                رجوع
            </a>
        </div>

    </form>

</div>

<script>
    const bookPrice = <?php echo e($borrow->libraryBook->price ?? 0); ?>;
    const seriesPartsCount = <?php echo e($borrow->libraryBook->series_parts_count ?? 0); ?>;

    const returnStatus = document.getElementById('return_status');
    const lostBookBox = document.getElementById('lost_book_box');
    const compensationType = document.getElementById('loss_compensation_type');
    const compensationAmount = document.getElementById('loss_compensation_amount');
    const fineAmount = document.getElementById('fine_amount');

    returnStatus.addEventListener('change', function () {
        if (this.value === 'lost') {
            lostBookBox.style.display = 'block';
        } else {
            lostBookBox.style.display = 'none';
            compensationType.value = '';
            compensationAmount.value = 0;
        }
    });

    compensationType.addEventListener('change', function () {
        if (this.value === 'replacement') {
            compensationAmount.value = 0;
        }

        if (this.value === 'pay_five_times') {
            compensationAmount.value = bookPrice * 5;
        }

        if (this.value === 'pay_series') {
            compensationAmount.value = bookPrice * seriesPartsCount;
        }

        fineAmount.value = compensationAmount.value;
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/borrows/return.blade.php ENDPATH**/ ?>