<?php $__env->startSection('page_title', 'الرئيسية'); ?>

<?php $__env->startSection('content'); ?>
    <div class="cards">
        <div class="card">
            <h3>طلبات الاستعارة</h3>
            <p><?php echo e($borrowRequestsCount ?? 0); ?></p>
        </div>

        <div class="card">
            <h3>عدد الطلبة</h3>
            <p><?php echo e($studentsCount ?? 0); ?></p>
        </div>

        <div class="card">
            <h3>عدد الكتب</h3>
            <p><?php echo e($booksCount ?? 0); ?></p>
        </div>

        <div class="card">
            <h3>عدد الأقسام</h3>
            <p><?php echo e($departmentsCount ?? 0); ?></p>
        </div>
    </div>

    <div class="section-box">
        <h2>آخر طلبات الاستعارة</h2>

        <?php if(isset($latestBorrows) && $latestBorrows->count()): ?>
            <table>
                <thead>
                    <tr>
                        <th>الطالب</th>
                        <th>الكتاب</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $latestBorrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($borrow->user->name ?? '-'); ?></td>
                            <td><?php echo e($borrow->libraryBook->title ?? '-'); ?></td>
                            <td><?php echo e($borrow->status); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>لا توجد طلبات استعارة حالياً.</p>
        <?php endif; ?>
    </div>

    <div class="section-box">
        <h2>آخر الكتب المضافة</h2>

        <?php if(isset($latestBooks) && $latestBooks->count()): ?>
            <table>
                <thead>
                    <tr>
                        <th>اسم الكتاب</th>
                        <th>القسم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $latestBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($book->title); ?></td>
                            <td><?php echo e($book->department->name ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>لا توجد كتب مضافة حالياً.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>