<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/item.css') }}" />
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
        <div class="category">
            <form action="">
            <a href="" class="recommendation">おすすめ</a>
            <a href="" class="list">マイリスト</a>
            </form>
        </div>
        <div class="line"></div>
        <div class="products">
            @foreach ($items as $item)
            <div class="product">
                <a href="/item/{{$item->id}}" class="product_link"></a>
                <img src="{{$item->product_image}}" alt="商品画像" class="product_image" width="300" height="300">
                <p class="product_name">{{$item->product_name}}</p>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>