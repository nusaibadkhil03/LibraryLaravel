

<?php $__env->startSection('content'); ?>
<style>
.admin-table-page {
    padding: 35px !important;
    direction: rtl !important;
}

.admin-table-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 25px !important;
}

.admin-table-header h2 {
    margin: 0 !important;
    color: #333 !important;
}

.admin-add-btn {
    background: #e67e22 !important;
    color: white !important;
    padding: 10px 22px !important;
    border-radius: 25px !important;
    text-decoration: none !important;
    font-weight: bold !important;
}

.admin-table-card {
    background: #fff !important;
    border-radius: 18px !important;
    padding: 25px !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.10) !important;
    overflow-x: auto !important;
}

.admin-table {
    width: 100% !important;
    border-collapse: collapse !important;
}

.admin-table th {
    background: #e67e22 !important;
    color: white !important;
    padding: 14px !important;
    text-align: center !important;
}

.admin-table td {
    padding: 13px !important;
    text-align: center !important;
    border-bottom: 1px solid #eee !important;
    color: #333 !important;
}

.admin-table tr:hover {
    background: #fff7f0 !important;
}

.file-btn {
    display: inline-block !important;
    min-width: 95px !important;
    background: #2c7be5 !important;
    color: white !important;
    padding: 8px 14px !important;
    border-radius: 20px !important;
    text-decoration: none !important;
    font-size: 14px !important;
    white-space: nowrap !important;
    text-align: center !important;
}

.delete-btn {
    background: #dc3545 !important;
    color: white !important;
    border: none !important;
    padding: 7px 15px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
}

.success-message {
    background: #eaf8ee !important;
    color: #218838 !important;
    padding: 12px 18px !important;
    border-radius: 12px !important;
    margin-bottom: 18px !important;
}

.empty-table {
    text-align: center !important;
    color: #999 !important;
    padding: 25px !important;
}

.admin-header-actions {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    flex-wrap: wrap !important;
}

.admin-filter-form {
    display: flex !important;
    gap: 10px !important;
    align-items: center !important;
}

.admin-filter-form select {
    padding: 11px 15px !important;
    border: 1px solid #ddd !important;
    border-radius: 12px !important;
    background: white !important;
    min-width: 170px !important;
    font-family: inherit !important;
}
.view-btn {
    background: #2563eb;
    color: white !important;
    padding: 7px 15px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: bold;
}
</style>
<div class="section-box">

    <div class="admin-page-header">

        <h2>مشاريع التخرج</h2>

        <div class="admin-header-actions">

            <form method="GET"
                  action="<?php echo e(route('admin.projects.index')); ?>"
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

            <a href="<?php echo e(route('admin.projects.create')); ?>" class="admin-add-btn">
                + إضافة مشروع
            </a>

        </div>

    </div>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; padding:10px; margin:10px 0; border-radius:8px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($projects->count()): ?>
        <table style="width:100%; margin-top:20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المشروع</th>
                    <th>القسم</th>
                    <th>الطلبة</th>
                    <th>المشرف</th>
                    <th>السنة</th>
                    <th>الفصل</th>
                    <th>الملف</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department->name ?? '-'); ?></td>
                        <td><?php echo e($item->students_names ?? '-'); ?></td>
                        <td><?php echo e($item->supervisor_name ?? '-'); ?></td>
                        <td><?php echo e($item->academic_year ?? '-'); ?></td>
                        <td><?php echo e($item->semester ?? '-'); ?></td>

                        <td>
                            <?php if($item->file_path): ?>
                                <a href="<?php echo e(asset('storage/'.$item->file_path)); ?>"
                                   target="_blank"
                                   class="view-btn">
                                    قراءة
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>

                        <td>
                            <form action="<?php echo e(route('admin.projects.destroy', $item->id)); ?>"
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
        <p>لا توجد مشاريع حالياً</p>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/projects/index.blade.php ENDPATH**/ ?>