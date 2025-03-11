<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送付先住所変更画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/address.css') }}" />
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
        <h1>住所の変更</h1>
        <form action="/purchase/address" method="">
        @csrf
            <label for="sending_code" class="label">郵便番号</label>
            <input id="sending_code" type="text" name="sending_code" class="text" value="{{ old('sending_code') }}">
            @error('sending_code')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('sending_code')}}</p>
                </span>
            @enderror
            <label for="sending_address" class="label">住所</label>
            <input id="sending_address" type="text" name="sending_address" class="text" value="{{ old('sending_address') }}">
            @error('sending_address')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('sending_address')}}</p>
                </span>
            @enderror
            <label for="sending_building" class="label">建物名</label>
            <input id="sending_building" type="text" name="sending_building" class="text">
            <div class="button-content">
                <button class="button-update" type="submit">更新する</button>
            </div>
        </form>
    </main>
</body>
</html>