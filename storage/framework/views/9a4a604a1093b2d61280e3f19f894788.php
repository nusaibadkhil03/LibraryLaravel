

<?php $__env->startSection('content'); ?>
 <style>
    .admin-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 15px;
}

.admin-page-header h2 {
    color: #e67e22;
    font-size: 30px;
    margin: 0;
}

.admin-header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.admin-filter-form {
    display: flex;
    gap: 10px;
    align-items: center;
}

.admin-filter-form select {
    padding: 12px 18px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: white;
    min-width: 170px;
    font-family: inherit;
    font-size: 15px;
}

.admin-add-btn {
    background: #e67e22;
    color: white !important;
    text-decoration: none;
    padding: 13px 24px;
    border-radius: 14px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
}

.admin-add-btn:hover {
    background: #cf711f;
}
 </style>
<div class="section-box">

    <div class="admin-page-header">

        <h2>البحوث العلمية</h2>

        <div class="admin-header-actions">

            <form method="GET"
                  action="<?php echo e(route('admin.researches.index')); ?>"
                  class="admin-filter-form">

                <select name="department_id" onchange="this.form.submit()">
                    <option value="">كل الأقسام</option>

                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"
                            <?php echo e(request('department_id') == $department->id ? 'selected' : ''); ?>>
                            <?php echo e($department->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="sort" onchange="this.form.submit()">
                    <option value="">الأحدث أولاً</option>

                    <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>
                        الأقدم أولاً
                    </option>

                    <option value="title" <?php echo e(request('sort') == 'title' ? 'selected' : ''); ?>>
                        ترتيب أبجدي
                    </option>
                </select>

            </form>

            <a href="<?php echo e(route('admin.researches.create')); ?>"
               class="admin-add-btn">
                + إضافة بحث
            </a>

        </div>

    </div>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($researches->count()): ?>
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان البحث</th>
                    <th>القسم</th>
                    <th>الباحث</th>
                    <th>السنة</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $researches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department->name ?? '-'); ?></td>
                        <td><?php echo e($item->author ?? '-'); ?></td>
                        <td><?php echo e($item->publication_year ?? '-'); ?></td>

                        <td>
                            <a href="<?php echo e(asset('storage/'.$item->file_path)); ?>"
                               target="_blank">
                                عرض
                            </a>
                        </td>

                        <td>
                            <form action="<?php echo e(route('admin.researches.destroy', $item->id)); ?>"
                                  method="POST"
                                  onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>لا توجد بحوث علمية حالياً.</p>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/researches/index.blade.php ENDPATH**/ ?>