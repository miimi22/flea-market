<?php $__env->startSection('meta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<title>商品詳細画面</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/detail.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="product-detail">
    <div class="product-image-area">
        <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="product-image">
    </div>
    <div class="product-description-area">
        <div class="product-title">
            <h1 class="product-name"><?php echo e($item->product_name); ?></h1>
            <p class="brand-name"><?php echo e($item->brand_name); ?></p>
            <span class="yen">¥</span><span class="product-price"><?php echo e(number_format($item->product_price)); ?></span><span class="tax-included">(税込)</span>
            <div class="product-actions">
                <form id="likeForm">
                    <div class="like-container">
                        <button class="like-button <?php echo e($isLiked ? 'liked' : ''); ?>" id="likeButton" type="button"><img src="<?php echo e(asset('images/star.png')); ?>" alt="いいね" class="star"></button>
                        <div class="like-count" id="likeCount"><?php echo e($item->likes->count()); ?></div>
                    </div>
                </form>
                <div class="comment-container">
                    <img src="<?php echo e(asset('images/comment.png')); ?>" alt="コメント" class="comment">
                    <div class="comment-count" id="commentCount"><?php echo e($item->comments->count()); ?></div>
                </div>
            </div>
        </div>
        <div class="purchase-area">
            <a href="/purchase/<?php echo e($item->id); ?>" class="purchase-button">購入手続きへ</a>
        </div>
        <div class="product-description">
            <h2 class="product-description-title">商品説明</h2>
            <p class="description"><?php echo e($item->product_description); ?></p>
        </div>
        <div class="product-info">
            <h2 class="product-info-title">商品の情報</h2>
            <span class="category-info">カテゴリー</span>
            <?php $__currentLoopData = $item->itemcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="category-info-text"><?php echo e($category->category->category); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <br>
            <span class="product-condition">商品の状態</span>
            <span class="product-condition-text"><?php echo e($item->condition->content); ?></span>
        </div>
        <div class="product-comments">
            <h2 class="product-comments-title">コメント(<?php echo e($item->comments->count()); ?>)</h2>
            <div class="comments-list">
                <?php $__currentLoopData = $item->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e($comment->user->profile && $comment->user->profile->profile_image ? asset($comment->user->profile->profile_image) : asset('images/default.png')); ?>" alt="画像" class="comments-image" width="50" height="50">
                    <span class="name"><?php echo e($comment->user->name); ?></span>
                    <div class="comments-text">
                        <span class="comments"><?php echo e($comment->comment); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="comment-input">
            <h3 class="comment-input-title">商品へのコメント</h3>
            <form action="<?php echo e(url('/item/' . $item->id . '/comments')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="comment-area">
                    <textarea name="comment" id="commentsForm" class="comments-form"></textarea>
                </div>
                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="textarea_error">
                        <p class="textarea_error_message"><?php echo e($errors->first('comment')); ?></p>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="comments-button">
                    <button class="comments-button-submit" type="submit">コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButton = document.getElementById('likeButton');
        const likeCountElement = document.getElementById('likeCount');
        const itemId = <?php echo e($item->id); ?>;

        likeButton.addEventListener('click', function () {
            fetch(`/like/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                likeCountElement.textContent = data.likeCount;
                if (data.liked) {
                    likeButton.classList.add('liked');
                } else {
                    likeButton.classList.remove('liked');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .like-button.liked {
    background-color: yellow;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/detail.blade.php ENDPATH**/ ?>