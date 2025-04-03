@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
<title>商品購入画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
@endsection

@section('content')
<div class="contents">
    <div class="left-contents">
        <div class="product-image-area">
            <img src="{{asset($item->product_image)}}" alt="商品画像" class="product-image" width="200" height="200">
            <div class="product-image-area-text">
                <h1 class="product-name">{{$item->product_name}}</h1>
                <span class="yen">¥</span>&nbsp;<span class="product-price">{{number_format($item->product_price)}}</span>
            </div>
        </div>
        <div class="border1"></div>
        <form action="/purchase/address/{{$item->id}}" method="get">
        @csrf
        <div class="payment-area">
            <h2 class="payment-method-title">支払い方法</h2>
            <div class="select-inner">
                <select name="payment_content" id="payment-method-select" class="payment-method-select">
                    <option disabled selected style="display:none;">選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード支払い">カード支払い</option>
                </select>
            </div>
            @error('payment_content')
                <span class="select_error">
                    <p class="select_error_message">{{$errors->first('payment_content')}}</p>
                </span>
            @enderror
        </div>
        <div class="border2"></div>
        <div class="shipping-address-nav">
            <h2 class="shipping-address-title">配送先</h2>                
                <button class="shipping-address-change" type="submit">変更する</button>
        </form>
        </div>
        <div class="shipping-address-area">
            @if ($userProfile)
            <span class="post-mark">〒</span>&nbsp;<span class="post-code">{{ $userProfile->post_code }}</span><br>
            <span class="address">{{ $userProfile->address }}</span><span class="building">{{ $userProfile->building }}</span>
            @endif
        </div>
        <div class="border3"></div>
    </div>
    <div class="right-contents">
        <form id="payment-form" action="/purchase/stripe" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <input type="hidden" name="payment_content" id="hidden-payment-method">
            <table>
                <tr>
                    <td>商品代金</td>
                    <td>¥&nbsp;{{number_format($item->product_price)}}</td>
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
@endsection

@section('script')
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
                        item_id: {{ $item->id }},
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
@endsection