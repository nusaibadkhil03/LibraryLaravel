<?php $__env->startSection('title', 'استعارة كتاب'); ?>

<?php $__env->startSection('content'); ?>

<div class="borrow-container">

    <div class="tabs" id="main-tabs">
        <button type="button" class="tab-btn active" onclick="showTab('request-form-container', this)">طلب استعارة</button>
        <button type="button" class="tab-btn" onclick="showTab('status-view', this)">حالة الطلب</button>
    </div>

    <div id="request-form-container" class="form-section active">

        <h2>تقديم طلب استعارة</h2>

        <?php if(session('success')): ?>
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:8px; text-align:center;">
                الرجاء اختيار كتاب صحيح من القائمة.
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('borrow.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-grid">
                <div class="input-box">
                    <label>اسم الطالب *</label>
                    <input type="text" name="student_name" placeholder="أدخل اسمك الكامل" required>
                </div>

                <div class="input-box">
                    <label>رقم القيد *</label>
                    <input type="text" name="student_id" placeholder="مثال: 202012345" required>
                </div>
            </div>

            <div class="form-grid">
    <div class="input-box">
        <label>القسم</label>
        <input type="text"
               value="<?php echo e(auth()->user()->department->name ?? '-'); ?>"
               readonly>
    </div>

    <div class="input-box">
        <label>رقم الهاتف</label>
        <input type="text"
               name="phone"
               value="<?php echo e(auth()->user()->phone ?? ''); ?>"
               readonly>
    </div>
</div>

            <div class="input-box">
                <label>اسم الكتاب *</label>

                <input
                    list="booksList"
                    id="bookSearch"
                    placeholder="اكتب اسم الكتاب..."
                    autocomplete="off"
                    required
                    style="padding:10px; width:100%;"
                >

                <datalist id="booksList">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option data-id="<?php echo e($book->id); ?>" value="<?php echo e($book->title); ?>"></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </datalist>

                <input type="hidden" name="book_id" id="book_id">
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>اسم المؤلف</label>
                    <input type="text" name="author">
                </div>

                <div class="input-box">
                    <label>رقم الطبعة</label>
                    <input type="text" name="edition">
                </div>
            </div>

            <div class="form-grid">
                <div class="input-box">
                    <label>تاريخ الاستعارة</label>
                    <input type="date" id="borrow_date">
                </div>

                <div class="input-box">
                    <label>تاريخ الإرجاع المتوقع</label>
                    <input type="text" id="return_date_display" readonly>
                </div>
            </div>

           <div style="
    background:#fff8e1;
    color:#7a5a00;
    border:1px solid #ffe08a;
    padding:10px 14px;
    border-radius:12px;
    margin:15px 0;
    font-size:14px;
    display:flex;
    align-items:center;
    gap:8px;
">
    <span style="font-size:18px;">⚠️</span>
    <span>
        <strong>تنبيه:</strong>
        في حالة التأخر عن تاريخ الإرجاع سيتم تطبيق غرامة مالية.
    </span>
</div>

           <div class="borrow-actions">

    <button type="submit" class="borrow-submit-btn">
        إرسال الطلب
    </button>

    <a href="<?php echo e(url('/')); ?>" class="borrow-back-btn">
        الرجوع إلى الصفحة الرئيسية
    </a>

</div>
        </form>
    </div>

    <div id="status-view" class="form-section" style="display:none;">
        <h2>متابعة حالة الطلب</h2>

        <?php if(isset($borrows) && $borrows->count()): ?>
            <?php $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div style="
                    background:#fff;
                    padding:15px;
                    margin-bottom:10px;
                    border-radius:10px;
                    box-shadow:0 2px 8px rgba(0,0,0,0.1);
                ">

                    <p style="font-weight:bold;">
                        📘 <?php echo e($borrow->libraryBook->title ?? '-'); ?>

                    </p>

                    <?php if($borrow->status == 'pending'): ?>
                        <span style="color:#e67e22; font-weight:bold;">⏳ قيد المراجعة</span>

                    <?php elseif($borrow->status == 'approved' || $borrow->status == 'borrowed'): ?>
                        <span style="color:green; font-weight:bold;">✅ تمت الموافقة</span>

                        <?php if($borrow->due_date): ?>
                            <p style="margin-top:8px;">
                                تاريخ الإرجاع المتوقع: <?php echo e($borrow->due_date); ?>

                            </p>
                        <?php endif; ?>

                    <?php elseif($borrow->status == 'returned'): ?>
                        <span style="color:#007bff; font-weight:bold;">📗 تم الإرجاع</span>

                    <?php elseif($borrow->status == 'rejected'): ?>
                        <span style="color:red; font-weight:bold;">❌ مرفوض</span>

                    <?php endif; ?>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>لا توجد طلبات حالياً</p>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function showTab(sectionId, button) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.style.display = 'none';
        section.classList.remove('active');
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    const section = document.getElementById(sectionId);
    if (section) {
        section.style.display = 'block';
        section.classList.add('active');
    }

    button.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const bookSearch = document.getElementById('bookSearch');
    const bookIdInput = document.getElementById('book_id');
    const options = document.querySelectorAll('#booksList option');

    if (bookSearch && bookIdInput) {
        bookSearch.addEventListener('input', function () {
            bookIdInput.value = '';

            options.forEach(option => {
                if (option.value === bookSearch.value) {
                    bookIdInput.value = option.dataset.id;
                }
            });
        });
    }

    const input = document.getElementById("borrow_date");
    const output = document.getElementById("return_date_display");

    if (!input || !output) return;

    input.addEventListener("input", function () {
        if (!input.value) return;

        let borrowDate = new Date(input.value);
        borrowDate.setDate(borrowDate.getDate() + 14);

        const year = borrowDate.getFullYear();
        const month = String(borrowDate.getMonth() + 1).padStart(2, '0');
        const day = String(borrowDate.getDate()).padStart(2, '0');

        output.value = `${year}-${month}-${day}`;
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.borrow_layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/borrow.blade.php ENDPATH**/ ?>