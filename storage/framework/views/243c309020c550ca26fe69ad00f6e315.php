<?php $__env->startSection('page_title', 'إدارة الكتب '); ?>

<?php $__env->startSection('content'); ?>

<style>
.books-page {
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.books-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.books-header h2 {
    margin: 0;
}

.add-book-btn {
    background: #e67e22;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
}

.filter-box {
    background: #fafafa;
    padding: 18px;
    border-radius: 16px;
    margin: 20px 0;
    border: 1px solid #eee;
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
    align-items: end;
}

.filter-box label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #444;
    font-size: 14px;
}

.filter-box input,
.filter-box select {
    width: 100%;
    border-radius: 12px;
    border: 1px solid #ddd;
    padding: 11px 14px;
    background: white;
    font-family: inherit;
}

.filter-box input:focus,
.filter-box select:focus {
    outline: none;
    border-color: #e67e22;
}

.filter-actions {
    display: flex;
    gap: 8px;
}

.search-btn,
.reset-btn {
    border: none;
    padding: 11px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    text-align: center;
}

.search-btn {
    background: #e67e22;
    color: white;
}

.reset-btn {
    background: #6c757d;
    color: white;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid #eee;
}

.books-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 950px;
    background: white;
}

.books-table thead {
    background: #f3f4f6;
}

.books-table th,
.books-table td {
    padding: 13px 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    vertical-align: middle;
}

.books-table th {
    color: #333;
    font-weight: bold;
}

.book-title {
    font-weight: bold;
    color: #222;
    max-width: 190px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
}

.status-available {
    background: #dcfce7;
    color: #166534;
}

.status-unavailable {
    background: #fee2e2;
    color: #991b1b;
}

.details-box summary {
    cursor: pointer;
    color: #e67e22;
    font-weight: bold;
}

.details-content {
    margin-top: 12px;
    background: #fafafa;
    padding: 12px;
    border-radius: 12px;
    min-width: 260px;
    text-align: right;
    line-height: 1.9;
    border: 1px solid #eee;
}

.details-content p {
    margin: 4px 0;
}

.delete-btn {
    background: #dc2626;
    color: white;
    border: none;
    padding: 8px 13px;
    border-radius: 9px;
    cursor: pointer;
    font-weight: bold;
}

.empty-message {
    margin-top: 20px;
    background: #fafafa;
    padding: 25px;
    border-radius: 14px;
    text-align: center;
    color: #666;
}

@media (max-width: 700px) {
    .books-page {
        padding: 16px;
    }

    .books-header {
        flex-direction: column;
        align-items: stretch;
    }

    .add-book-btn {
        text-align: center;
    }

    .filter-actions {
        flex-direction: column;
    }
}
</style>

<div class="section-box books-page">

    <div class="books-header">
        <h2>إدارة الكتب </h2>

        <a href="<?php echo e(route('admin.books.create')); ?>" class="add-book-btn">
            + إضافة كتاب جديد
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form method="GET" action="<?php echo e(route('admin.books.index')); ?>" class="filter-box">
        <div class="filter-grid">

            <div>
                <label>بحث</label>
                <input type="text"
                       name="search"
                       value="<?php echo e(request('search')); ?>"
                       placeholder="العنوان، المؤلف، الناشر، رقم التسجيل">
            </div>

            <div>
                <label>القسم</label>
                <select name="department_id">
                    <option value="">كل الأقسام</option>

                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"
                            <?php echo e(request('department_id') == $department->id ? 'selected' : ''); ?>>
                            <?php echo e($department->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label>التصنيف</label>
                <input type="text"
                       name="category_name"
                       value="<?php echo e(request('category_name')); ?>"
                       placeholder="اكتب التصنيف">
            </div>

            <div>
                <label>سنة النشر</label>
                <input type="number"
                       name="publication_year"
                       value="<?php echo e(request('publication_year')); ?>"
                       placeholder="مثال: 2024">
            </div>

            <div>
                <label>الحالة</label>
                <select name="status">
                    <option value="">كل الحالات</option>
                    <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>>
                        متاح
                    </option>
                    <option value="unavailable" <?php echo e(request('status') == 'unavailable' ? 'selected' : ''); ?>>
                        غير متاح
                    </option>
                </select>
            </div>

            <div>
                <label>الترتيب</label>
                <select name="sort">
                    <option value="">الأحدث</option>
                    <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>الأقدم</option>
                    <option value="title" <?php echo e(request('sort') == 'title' ? 'selected' : ''); ?>>العنوان</option>
                    <option value="year_desc" <?php echo e(request('sort') == 'year_desc' ? 'selected' : ''); ?>>سنة النشر الأحدث</option>
                    <option value="copies_desc" <?php echo e(request('sort') == 'copies_desc' ? 'selected' : ''); ?>>الأكثر نسخًا</option>
                    <option value="available_desc" <?php echo e(request('sort') == 'available_desc' ? 'selected' : ''); ?>>الأكثر توفرًا</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="search-btn">تطبيق</button>

                <a href="<?php echo e(route('admin.books.index')); ?>" class="reset-btn">
                    إعادة ضبط
                </a>
            </div>

        </div>
    </form>

    <?php if($books->count()): ?>

        <div class="table-wrapper">
            <table class="books-table">
               <thead>
    <tr>
        <th>#</th>
        <th>رقم التسجيل</th>
        <th>العنوان</th>
        <th>المؤلف</th>
        <th>الطبعة</th>
        <th>النسخ</th>
        <th>مكان النشر</th>
        <th>الحالة</th>
        <th>التفاصيل</th>
        <th>حذف</th>
    </tr>
</thead>
                <tbody>
    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>

            <td><?php echo e($book->book_number ?? '-'); ?></td>

            <td class="book-title">
                <?php echo e($book->title); ?>

            </td>

            <td><?php echo e($book->author ?? '-'); ?></td>

            <td><?php echo e($book->edition_number ?? '-'); ?></td>

            <td><?php echo e($book->total_copies); ?></td>

            <td><?php echo e($book->publication_place ?? '-'); ?></td>

            <td>
                <?php if($book->status == 'available'): ?>
                    <span class="status-badge status-available">متاح</span>
                <?php else: ?>
                    <span class="status-badge status-unavailable">غير متاح</span>
                <?php endif; ?>
            </td>

            <td>
                <details class="details-box">
                    <summary>عرض</summary>

                    <div class="details-content">
                        <p><strong>القسم:</strong> <?php echo e($book->department->name ?? $book->department_name ?? '-'); ?></p>
                        <p><strong>الناشر:</strong> <?php echo e($book->publisher ?? '-'); ?></p>
                        <p><strong>سنة النشر:</strong> <?php echo e($book->publication_year ?? '-'); ?></p>
                        <p><strong>مكان النشر:</strong> <?php echo e($book->publication_place ?? '-'); ?></p>
                        <p><strong>التصنيف:</strong> <?php echo e($book->category_name ?? '-'); ?></p>
                        <p><strong>رقم الطبعة:</strong> <?php echo e($book->edition_number ?? '-'); ?></p>
                        <p><strong>مكان الرف:</strong> <?php echo e($book->shelf_location ?? '-'); ?></p>
                        <p><strong>النسخ المتاحة:</strong> <?php echo e($book->available_copies); ?></p>
                        <p><strong>النسخ المستعارة:</strong> <?php echo e($book->total_copies - $book->available_copies); ?></p>

                        <?php if(!empty($book->is_series)): ?>
                            <hr>
                            <p><strong>نوع الكتاب:</strong> تابع لسلسلة</p>
                            <p><strong>اسم السلسلة:</strong> <?php echo e($book->series_name ?? '-'); ?></p>
                            <p><strong>رقم الجزء:</strong> <?php echo e($book->part_number ?? '-'); ?> من <?php echo e($book->series_parts_count ?? '-'); ?></p>
                        <?php else: ?>
                            <p><strong>نوع الكتاب:</strong> كتاب مستقل</p>
                        <?php endif; ?>

                        <hr>

                        <p><strong>الوصف:</strong> <?php echo e($book->description ?? '-'); ?></p>

                        <p>
                            <strong>سياسة الفقدان:</strong>
                            <?php echo e($book->loss_policy ?? 'إحضار نسخة بديلة أو دفع خمسة أضعاف سعر الكتاب، وفي حال كان ضمن سلسلة يتم دفع قيمة السلسلة كاملة.'); ?>

                        </p>
                    </div>
                </details>
            </td>

            <td>
                <form action="<?php echo e(route('admin.books.destroy', $book->id)); ?>"
                      method="POST"
                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button class="delete-btn">
                        حذف
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

            </table>
        </div>

    <?php else: ?>
        <div class="empty-message">
            لا توجد كتب حالياً.
        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/admin/books/index.blade.php ENDPATH**/ ?>