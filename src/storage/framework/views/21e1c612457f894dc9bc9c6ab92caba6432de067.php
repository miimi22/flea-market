<?php $__env->startSection('meta'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<title>商品購入画面</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/purchase.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="contents">
    <div class="left-contents">
        <div class="product-image-area">
            <img src="<?php echo e(asset($item->product_image)); ?>" alt="商品画像" class="product-image" width="200" height="200">
            <div class="product-image-area-text">
                <h1 class="product-name"><?php echo e($item->product_name); ?></h1>
                <span class="yen">¥</span>&nbsp;<span class="product-price"><?php echo e(number_format($item->product_price)); ?></span>
            </div>
        </div>
        <div class="border1"></div>
        <form action="/purchase/address/<?php echo e($item->id); ?>" method="get">
        <?php echo csrf_field(); ?>
        <div class="payment-area">
            <h2 class="payment-method-title">支払い方法</h2>
            <div class="select-inner">
                <select name="payment_content" id="payment-method-select" class="payment-method-select">
                    <option disabled selected style="display:none;">選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード支払い">カード支払い</option>
                </select>
            </div>
            <?php $__errorArgs = ['payment_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="select_error">
                    <p class="select_error_message"><?php echo e($errors->first('payment_content')); ?></p>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="border2"></div>
        <div class="shipping-address-nav">
            <h2 class="shipping-address-title">配送先</h2>                
                <button class="shipping-address-change" type="submit">変更する</button>
        </form>
        </div>
        <div class="shipping-address-area">
            <?php if($userProfile): ?>
            <span class="post-mark">〒</span>&nbsp;<span class="post-code"><?php echo e($userProfile->post_code); ?></span><br>
            <span class="address"><?php echo e($userProfile->address); ?></span><span class="building"><?php echo e($userProfile->building); ?></span>
            <?php endif; ?>
        </div>
        <div class="border3"></div>
    </div>
    <div class="right-contents">
        <form id="payment-form" action="/purchase/stripe" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
            <input type="hidden" name="payment_content" id="hidden-payment-method">
            <table>
                <tr>
                    <td>商品代金</td>
                    <td>¥&nbsp;<?php echo e(number_format($item->product_price)); ?></td>
                </tr>
                <tr>
                    <td>支払い方法</td>
                    <td id="selected-payment-method"></td>
                </tr>
            </table>
            <button type="button" id="purchase-button" class="purchase-button">購入する</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentSelect = document.getElementById('payment-method-select');
        const selectedPaymentMethod = document.getElementById('selected-payment-method');
        const hiddenPaymentMethod = document.getElementById('hidden-payment-method');
        const purchaseButton = document.getElementById('purchase-button');
        const paymentForm = document.getElementById('payment-form');
        const stripe = Stripe('pk_test_51R5ivkBMK4Sj2g3hDPVzSyDPlPrJj1NTr1dzm0CN8HIXf0LpU0ieXF1tOg1Eys9shiTwJDZtyxrk77WFa1Gq4HML00zAFNGMHA');

        function updatePaymentMethod() {
            if (paymentSelect.value) {
                selectedPaymentMethod.textContent = paymentSelect.value;
                hiddenPaymentMethod.value = paymentSelect.value;
            } else {
                selectedPaymentMethod.textContent = '';
                hiddenPaymentMethod.value = '';
            }
        }

        updatePaymentMethod();

        paymentSelect.addEventListener('change', updatePaymentMethod);

        purchaseButton.addEventListener('click', function () {
            if (paymentSelect.value) {
                fetch('/purchase/stripe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        item_id: <?php echo e($item->id); ?>,
                        payment_content: paymentSelect.value
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(session => {
                    return stripe.redirectToCheckout({ sessionId: session.id });
                })
                .then(result => {
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    alert('決済処理中にエラーが発生しました。');
                });
            } else {
                alert('支払い方法を選択してください。');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/purchase.blade.php ENDPATH**/ ?>