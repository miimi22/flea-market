<?php $__env->startSection('title'); ?>
<title>商品一覧画面</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/item.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="contents">
    <div class="category">
        <a href="/?keyword=<?php echo e(request('keyword')); ?>" class="recommendation" data-target="true">おすすめ</a>
        <a href="?tab=mylist&keyword=<?php echo e(request('keyword')); ?>" class="mylist <?php echo e(request('tab') == 'mylist' ? 'active' : ''); ?>" data-target="true">マイリスト</a>
    </div>
    <div class="line"></div>
    <div class="products-container">
        <div class="products">
            <?php if(request('tab') == null): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product">
                    <a href="/item/<?php echo e($item->id); ?>" class="product_link"></a>
                    <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="product_image" width="300" height="300">
                    <div class="product-list">
                        <p class="product_name"><?php echo e($item->product_name); ?></p>
                        <?php if($item->isSold()): ?>
                            <p class="sold-label">sold</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif(request('tab') == 'mylist' && Auth::check()): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product">
                    <a href="/item/<?php echo e($item->id); ?>" class="product_link"></a>
                    <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="product_image" width="300" height="300">
                    <div class="product-list">
                        <p class="product_name"><?php echo e($item->product_name); ?></p>
                        <?php if($item->isSold()): ?>
                            <p class="sold-label">sold</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    const currentPageUrl = window.location.href;
    const links = document.querySelectorAll('a[data-target="true"]');
    links.forEach(link => {
    const linkUrl = link.href;
    if (currentPageUrl === linkUrl) {
        link.classList.add('current-page-link');
    }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/item.blade.php ENDPATH**/ ?>