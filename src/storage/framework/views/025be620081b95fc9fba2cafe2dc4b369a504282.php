<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>取引完了のお知らせ</title>
</head>
<body>
    <h1><?php echo e($seller->name); ?> 様</h1>
    <p>出品中の商品の取引が終了しましたのでお知らせいたします。</p>
    <hr>
    <h2>取引情報</h2>
    <ul>
        <li>商品名: <?php echo e($item->product_name); ?></li>
        <li>商品価格: &yen;<?php echo e(number_format($item->product_price)); ?></li>
    </ul>
    <hr>
    <p>この度はご利用いただきありがとうございました。</p>
</body>
</html><?php /**PATH /var/www/resources/views/emails/transaction_completed.blade.php ENDPATH**/ ?>