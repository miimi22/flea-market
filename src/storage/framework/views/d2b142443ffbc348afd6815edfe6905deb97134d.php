<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $__env->yieldContent('meta'); ?>
    <?php echo $__env->yieldContent('title'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/sanitize.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/common.css')); ?>" />
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-left">
                <a href="/"><img src="<?php echo e(asset('images/logo.svg')); ?>" alt="coachtech" class="header-logo"></a>
            </div>
            <?php if(request()->path() != 'login' && request()->path() != 'register'): ?>
            <div class="header-right">
                <div class="keyword-content">
                    <form action="/">
                        <input type="text" class="keyword" name="keyword" placeholder="なにをお探しですか？" value="<?php echo e(request('keyword')); ?>">
                    </form>
                </div>
                <form action="/logout" method="post">
                    <?php echo csrf_field(); ?>
                <input id="drawer_input" class="drawer_hidden" type="checkbox">
                <label for="drawer_input" class="drawer_open"><span></span></label>
                <nav class="header-nav">
                    <ul class="header-nav-list">
                        <?php if(auth()->guard()->guest()): ?>
                        <li class="header-nav-item"><a href="/login" class="login-link">ログイン</a></li>
                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                        <li class="header-nav-item"><button class="logout-link">ログアウト</button></li>
                        <?php endif; ?>
                        <li class="header-nav-item"><a href="/mypage" class="mypage-link">マイページ</a></li>
                        <li class="header-nav-item"><a href="/sell" class="sell-link">出品</a></li>
                    </ul>
                </nav>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php echo $__env->yieldContent('script'); ?>
    <?php echo $__env->yieldContent('style'); ?>
</body>
</html><?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>