<?php $__env->startSection('page_title', 'إدارة الكتب الورقية'); ?>

<?php $__env->startSection('content'); ?>

<style>
.admin-card {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

input,
select {
    border-radius: 12px;
    border: 1px solid #ddd;
    padding: 10px 14px;
    background: #fafafa;
}

input:focus,
select:focus {
    border-color: #e67e22;
    background: #fff;
}

table {
    border-radius: 15px;
    overflow: hidden;
}
</style>
<div class="section-box">

    <h2>إدارة الكتب الورقية</h2>

    <div style="margin:20px 0;">
        <a href="<?php echo e(route('admin.books.create')); ?>">
            <button type="button" style="
                background:#e67e22;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:10px;
                cursor:pointer;
                font-weight:bold;
            ">
                + إضافة كتاب جديد
            </button>
        </a>
    </div>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    

    
    <?php if($books->count()): ?>

        <table style="width:100%; margin-top:20px; border-collapse: collapse;">

            <thead>
                <tr style="background:#eee;">

                    <th style="padding:10px;">#</th>

                    <th style="padding:10px;">العنوان</th>

                    <th style="padding:10px;">المؤلف</th>

                    <th style="padding:10px;">الناشر</th>

                    <th style="padding:10px;">سنة النشر</th>

                    <th style="padding:10px;">رقم التسجيل</th>

                    <th style="padding:10px;">رقم الطبعة</th>

                    <th style="padding:10px;">القسم</th>

                    <th style="padding:10px;">العدد الكلي</th>

                    <th style="padding:10px;">النسخ المتاحة</th>

                    <th style="padding:10px;">النسخ المستعارة</th>

                    <th style="padding:10px;">الحالة</th>

                    <th>حذف</th>

                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr style="border-bottom:1px solid #ddd;">

                        <td style="padding:10px;">
                            <?php echo e($loop->iteration); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->title); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->author ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->publisher ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->publication_year ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->book_number ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->edition_number ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->department->name ?? '-'); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->total_copies); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->available_copies); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->total_copies - $book->available_copies); ?>

                        </td>

                        <td style="padding:10px;">
                            <?php echo e($book->status); ?>

                        </td>

                        <td>
    <form action="<?php echo e(route('admin.books.destroy', $book->id)); ?>"
          method="POST"
          onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">

        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <button style="
            background:red;
            color:white;
            border:none;
            padding:8px 12px;
            border-radius:8px;
            cursor:pointer;">
            حذف
        </button>
    </form>
</td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

    <?php else: ?>

        <p style="margin-top:20px;">
            لا توجد كتب حالياً.
        </p>

    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/books/index.blade.php ENDPATH**/ ?>