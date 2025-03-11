<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
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
        <div class="user-content">
            <img class="image" src="images/default.png" width="100" height="100">
            <h1>ユーザー名</h1>
            <a href="/mypage/profile" class="edit-link">プロフィールを編集</a>
        </div>
        <div class="category">
            <form action="">
            <a href="" class="sell">出品した商品</a>
            <a href="" class="purchase">購入した商品</a>
            </form>
        </div>
        <div class="line"></div>
        <div class="merchandises">
            <div class="merchandise">
                <a href="/item" class="merchandise-link"></a>
                <img src="images/default.png" alt="商品画像" class="merchandise-image" width="300" height="300">
                <p class="merchandise-name">商品名</p>
            </div>
        </div>
    </main>
</body>
</html>