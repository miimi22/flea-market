<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <img src="{{ asset('images/logo.svg') }}" alt="coachtech">
            <div class="keyword-content">
                <form action="">
                    <input type="text" class="keyword" name="keyword" placeholder="なにをお探しですか？">
                </form>
            </div>
            <form action="/logout" method="post">
                @csrf
            <nav class="header-nav">
                <ul class="header-nav-list">
                    <li class="header-nav-item"><button class="logout-link">ログアウト</button></li>
                    <li class="header-nav-item"><a href="/mypage" class="mypage-link">マイページ</a></li>
                    <li class="header-nav-item"><a href="/sell" class="sell-link">出品</a></li>
                </ul>
            </nav>
            </form>
        </div>
    </header>
    <main class="contents">
        <div class="left-contents">
            <div class="product-image-area">
                <img src="images/default.png" alt="商品画像" class="product-image" width="200" height="200">
                <div class="product-image-area-text">
                    <h1 class="product-name">商品名</h1>
                    <span class="yen">¥</span>&nbsp;<span class="product-price">47,000</span>
                </div>
            </div>
            <div class="border1"></div>
            <div class="payment-area">
                <h2 class="payment-method-title">支払い方法</h2>
                <div class="select-inner">
                    <select name="payment-method-select" id="" class="payment-method-select">
                        <option disabled selected>選択してください</option>
                        @foreach ($payments as $payment)
                        <option value="{{$payment->id}}">{{$payment->content}}</option>
                        @endforeach
                    </select>
                </div>
                @error('payment_method')
                    <span class="select_error">
                        <p class="select_error_message">{{$errors->first('payment_method')}}</p>
                    </span>
                @enderror
            </div>
            <div class="border2"></div>
            <div class="shipping-address-nav">
                <h2 class="shipping-address-title">配送先</h2>
                <a href="/purchase/address" class="shipping-address-change">変更する</a>
            </div>
            <div class="shipping-address-area">
                <span class="post-mark">〒</span>&nbsp;<span class="post-code">XXX-YYYY</span><br>
                <span class="address">住所</span><span class="building">建物名</span>
            </div>
            <div class="border3"></div>
        </div>
        <form action="/purchase" method="post">
            <div class="right-contents">
                <table>
                    <tr>
                        <td>商品代金</td>
                        <td>¥&nbsp;47,000</td>
                    </tr>
                    <tr>
                        <td>支払い方法</td>
                        <td>コンビニ払い</td>
                    </tr>
                </table>
                <button class="purchase-button">購入する</button>
            </div>
        </form>
    </main>
</body>
</html>