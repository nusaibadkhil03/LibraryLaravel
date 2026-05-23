

<?php $__env->startSection('content'); ?>

<?php
    $slides = [
        [
            'image' => 'images/campus.jpeg',
            'title' => 'الجامعة الليبية للعلوم الإنسانية والتطبيقية',
            'text' => 'جامعة حاصلة على إذن مزاولة من وزارة التعليم العالي والبحث العلمي، ومعتمدة من المركز الوطني لضمان الجودة.'
        ],
        [
            'image' => 'images/library.jpg',
            'title' => 'المكتبة الجامعية',
            'text' => 'بيئة معرفية تدعم الطلبة بالمراجع والكتب والمحتوى الأكاديمي المنظم.'
        ],
        [
            'image' => 'images/computer.jpg',
            'title' => 'معامل الحاسب الآلي',
            'text' => 'مساحات تعليمية مجهزة لدعم الجانب التطبيقي والتقني داخل الجامعة.'
        ],
        [
            'image' => 'images/m.jpg',
            'title' => 'مرسم وقاعات التصميم',
            'text' => 'مساحات تعليمية تدعم الجانب الإبداعي والعملي داخل التخصصات الفنية والهندسية.'
        ],
        [
            'image' => 'images/class.jpg',
            'title' => 'القاعات الدراسية',
            'text' => 'بيئة أكاديمية حديثة تساعد الطلبة على التعلم والتفاعل داخل الجامعة.'
        ],
        [
            'image' => 'images/ph2.jpg',
            'title' => 'المعامل والقاعات الدراسية',
            'text' => 'قاعات ومعامل تساعد الطالب على الجمع بين الجانب النظري والتطبيقي.'
        ],
        [
            'image' => 'images/l.jpg',
            'title' => 'هوية الجامعة',
            'text' => 'هوية أكاديمية تعكس رؤية الجامعة في التعليم والبحث والتطوير.'
        ],
    ];
?>

<section class="about-cinematic">

    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="about-slide <?php echo e($index === 0 ? 'active' : ''); ?>"
             style="background-image: url('<?php echo e(asset($slide['image'])); ?>');"
             data-title="<?php echo e($slide['title']); ?>"
             data-text="<?php echo e($slide['text']); ?>">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="about-overlay"></div>

    <div class="about-cinematic-content">
        <h1 id="aboutTitle"><?php echo e($slides[0]['title']); ?></h1>

        <p id="aboutText">
            <?php echo e($slides[0]['text']); ?>

        </p>

        <div class="about-tags">
            <?php if(isset($departments)): ?>
                <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('departments.show', $department->slug)); ?>">
                        <?php echo e($department->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span>لا توجد أقسام حالياً</span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.about-slide');
    const title = document.getElementById('aboutTitle');
    const text = document.getElementById('aboutText');

    if (!slides.length || !title || !text) return;

    let current = 0;

    setInterval(() => {
        slides[current].classList.remove('active');

        current = (current + 1) % slides.length;

        slides[current].classList.add('active');

        title.style.opacity = 0;
        text.style.opacity = 0;

        setTimeout(() => {
            title.textContent = slides[current].dataset.title || '';
            text.textContent = slides[current].dataset.text || '';

            title.style.opacity = 1;
            text.style.opacity = 1;
        }, 500);

    }, 4000);
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\course laravel\LibraryLaravel\resources\views/about.blade.php ENDPATH**/ ?>