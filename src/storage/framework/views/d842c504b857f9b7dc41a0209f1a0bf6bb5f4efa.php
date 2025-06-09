<?php $__env->startSection('title'); ?>
<title>プロフィール画面</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="contents">
    <div class="user-content">
        <img class="image" src="<?php echo e($profile->profile_image ? asset($profile->profile_image) : asset('images/default.png')); ?>" width="100" height="100">
        <h1><?php echo e($user->name); ?></h1>
        <?php if(isset($ratingCount) && $ratingCount > 0): ?>
            <div class="user-rating">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <?php if($i <= $roundedRating): ?>
                        <span class="star-filled">★</span>
                    <?php else: ?>
                        <span class="star-empty">★</span>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
        <a href="/mypage/profile" class="edit-link">プロフィールを編集</a>
    </div>
    <div class="category">
        <a href="?tab=sell" class="sell <?php echo e(request('tab') == 'sell' ? 'active' : ''); ?>" data-target="true">出品した商品</a>
        <a href="?tab=buy" class="purchase <?php echo e(request('tab') == 'buy' ? 'active' : ''); ?>" data-target="true">購入した商品</a>
        <a href="?tab=trading" class="trading <?php echo e(request('tab') == 'trading' ? 'active' : ''); ?>" data-target="true">
            取引中の商品
            <?php if(isset($trading_message_count) && $trading_message_count > 0): ?>
                <span class="badge"><?php echo e($trading_message_count); ?></span>
            <?php endif; ?>
        </a>
    </div>
    <div class="line"></div>
    <div class="merchandises-container">
        <div class="merchandises">
            <?php if(request('tab') == 'sell' || request('tab') == null): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="merchandise">
                        <a href="/item/<?php echo e($item->id); ?>" class="merchandise-link"></a>
                        <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="merchandise-image" width="300" height="300">
                        <p class="merchandise-name"><?php echo e($item->product_name); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif(request('tab') == 'buy'): ?>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="merchandise">
                        <a href="/item/<?php echo e($payment->item->id); ?>" class="merchandise-link"></a>
                        <img src="<?php echo e(asset($payment->item->product_image)); ?>" alt="商品画像" class="merchandise-image" width="300" height="300">
                        <p class="merchandise-name"><?php echo e($payment->item->product_name); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif(request('tab') == 'trading'): ?>
                <?php if(isset($trading_items) && $trading_items->count() > 0): ?>
                    <?php $__currentLoopData = $trading_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="merchandise">
                            <?php if($item->unread_messages_count > 0): ?>
                                <span class="item-badge"><?php echo e($item->unread_messages_count); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo e(route('trading.show', ['item_id' => $item->id])); ?>" class="merchandise-link"></a>
                            <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="merchandise-image" width="300" height="300">
                            <p class="merchandise-name"><?php echo e($item->product_name); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p>取引中の商品はありません。</p>
                <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/profile.blade.php ENDPATH**/ ?>