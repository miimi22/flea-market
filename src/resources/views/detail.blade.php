<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
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
        <div class="product-detail">
            <div class="product-image-area">
                <img src="{{asset($item->product_image)}}" alt="商品画像" class="product-image">
            </div>
            <div class="product-description-area">
                <div class="product-title">
                    <h1 class="product-name">{{$item->product_name}}</h1>
                    <p class="brand-name">{{$item->brand_name}}</p>
                    <span class="yen">¥</span><span class="product-price">{{$item->product_price}}</span><span class="tax-included">(税込)</span>
                    <div class="product-actions">
                        <div class="like-container">
                            <button class="like-button" id="likeButton"><img src="{{asset('images/star.png')}}" alt="いいね" class="star"></button>
                            <div class="like-count" id="likeCount">0</div>
                        </div>
                        <div class="comment-container">
                            <img src="{{asset('images/comment.png')}}" alt="コメント" class="comment">
                            <div class="comment-count" id="commentCount">0</div>
                        </div>
                    </div>
                </div>
                <div class="purchase-area">
                    <a href="/purchase" class="purchase-button">購入手続きへ</a>
                </div>
                <div class="product-description">
                    <h2 class="product-description-title">商品説明</h2>
                    <p class="description">{{$item->product_description}}</p>
                </div>
                <div class="product-info">
                    <h2 class="product-info-title">商品の情報</h2>
                    <span class="category-info">カテゴリー</span>
                    <span class="category-info-text">{{$item->category_id}}</span><br>
                    <span class="product-condition">商品の状態</span>
                    <span class="product-condition-text">{{$item->condition_id}}</span>
                </div>
                <div class="product-comments">
                    <h2 class="product-comments-title">コメント(1)</h2>
                    <div class="comments-list">
                        <img src="images/default.png" alt="画像" class="comments-image" width="50" height="50">
                        <span class="name">admin</span>
                        <div class="comments-text">
                            <span class="comments">こちらにコメントが入ります。</span>
                        </div>
                    </div>
                </div>
                <div class="comment-input">
                    <h3 class="comment-input-title">商品へのコメント</h3>
                    <form action="/item" method="post">
                        <div class="comment-area">
                            <textarea name="comments-form" id="commentsForm" class="comments-form"></textarea>
                        </div>
                        @error('comment')
                            <span class="textarea_error">
                                <p class="textarea_error_message">{{$errors->first('comment')}}</p>
                            </span>
                        @enderror
                        <div class="comments-button">
                            <button class="comments-button-submit">コメントを送信する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        const likeButton = document.getElementById('likeButton');
        const likeCount = document.getElementById('likeCount');

        let count = 0;
        likeButton.addEventListener('click', () => {
            count++;

            likeCount.textContent = count;
        });
    </script>
</body>
</html>