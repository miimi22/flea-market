<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品出品画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}" />
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
        <h1 class="sell-title">商品の出品</h1>
        <form action="">
            <div class="sell-products-image">
                <h3 class="sell-products-image-title">商品画像</h3>
                <div class="sell-products-image-form">
                    <div id="preview" class="preview-image">
                        <label class="image-button-label">
                            画像を選択する
                            <input type="file" class="image-button" accept="image/*" id="inputElm">
                        </label>
                    </div>
                </div>
                @error('product_image')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('product_image')}}</p>
                    </span>
                @enderror
            </div>
            <div class="sell-product-detail-area">
                <h2 class="sell-product-product-detail">商品の詳細</h2>
                <div class="border"></div>
                <div class="sell-product-category-area">
                    <h3 class="category-title">カテゴリー</h3>
                    <div class="product-category-items">
                        @foreach ($categories as $category)
                        <input type="checkbox" class="product-category-item" id="category-{{$category->id}}" value="{{$category->id}}"><label for="category-{{$category->id}}">{{$category->category}}</label>
                        @endforeach
                    </div>
                    @error('product_category')
                        <span class="input_error">
                            <p class="input_error_message">{{$errors->first('product_category')}}</p>
                        </span>
                    @enderror
                </div>
                <div class="sell-product-status">
                    <h3 class="status-title">商品の状態</h3>
                    <div class="select-inner">
                        <select name="status-select" id="" class="status-select">
                            <option disabled selected>選択してください</option>
                            @foreach ($conditions as $condition)
                            <option value="{{$condition->id}}">{{$condition->content}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('status')
                        <span class="select_error">
                            <p class="select_error_message">{{$errors->first('status')}}</p>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="product-name-explanation">
                <h2 class="product-name-explanation-title">商品名と説明</h2>
                <div class="border"></div>
                <div class="product-name-area">
                    <h3 class="product-name-title">商品名</h3>
                    <input type="text" name="product-name" class="product-name">
                    @error('product_name')
                        <span class="input_error">
                            <p class="input_error_message">{{$errors->first('product_name')}}</p>
                        </span>
                    @enderror
                </div>
                <div class="brand-name-area">
                    <h3 class="brand-name-title">ブランド名</h3>
                    <input type="text" name="brand-name" class="brand-name">
                </div>
                <div class="product-explanation-area">
                    <h3 class="product-explanation-title">商品の説明</h3>
                    <textarea name="product-explanation" id="" class="product-explanation"></textarea>
                    @error('product_explanation')
                        <span class="textarea_error">
                            <p class="textarea_error_message">{{$errors->first('product_explanation')}}</p>
                        </span>
                    @enderror
                </div>
                <div class="product-price-area">
                    <h3 class="product-price-title">販売価格</h3>
                    <input type="text" name="product-price" class="product-price" placeholder="¥">
                    @error('product_price')
                        <span class="input_error">
                            <p class="input_error_message">{{$errors->first('product_price')}}</p>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="sell-button-area">
                <button class="sell-button-submit" type="submit">出品する</button>
            </div>
        </form>
    </main>
    <script>
        const inputElm = document.getElementById('inputElm');
        inputElm.addEventListener('change', (e) => {
            const file = e.target.files[0];
        
            const fileReader = new FileReader();
            // 画像を読み込む
            fileReader.readAsDataURL(file);

            // 画像読み込み完了時の処理
            fileReader.addEventListener('load', (e) => {
                // imgタグ生成
                const imgElm = document.createElement('img');
                imgElm.src = e.target.result; // e.target.resultに読み込んだ画像のURLが入っている
            
                // imgタグを挿入
                const targetElm = document.getElementById('preview');
                targetElm.appendChild(imgElm);
            });
        });
    </script>
</body>
</html>