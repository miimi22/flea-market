<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
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
        <h1>プロフィール設定</h1>
        <form action="" method="get" enctype="multipart/form-data">
            <div class="avatar-image">
            @if (!empty($file))
                <img class="c-avatar__image" id="preview" src="data:image/{{$mimeType}};base64,{{$file}}" width="100" height="100">
            @else
                <img class="c-avatar__image" id="preview" src="{{ asset('images/default.png') }}" width="100" height="100">
            @endif
            @error('profile_image')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('profile_image')}}</p>
                </span>
            @enderror
                <label class="image-button-label">
                    画像を選択する
                    <input type="file" class="image-button">
                </label>
            </div>
            <label for="name" class="label">ユーザー名</label>
            <input id="name" type="text" name="name" class="text" placeholder="">
            @error('name')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('name')}}</p>
                </span>
            @enderror
            <label for="post_code" class="label">郵便番号</label>
            <input id="post_code" type="text" name="post_code" class="text" placeholder="">
            @error('post_code')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('post_code')}}</p>
                </span>
            @enderror
            <label for="address" class="label">住所</label>
            <input id="address" type="text" name="address" class="text" placeholder="">
            @error('address')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('address')}}</p>
                </span>
            @enderror
            <label for="building" class="label">建物名</label>
            <input id="building" type="text" name="building" class="text" placeholder="">
            <div class="button-content">
                <button class="button-update">更新する</button>
            </div>
        </form>
    </main>
    <script>
        $('#imageUpload').on('change', function (e) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</body>
</html>

