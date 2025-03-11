<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <img src="{{ asset('images/logo.svg') }}" alt="coachtech">
        </div>
    </header>
    <main class="contents">
        <h1>ログイン</h1>
        <form action="/login" method="post">
        @csrf
            <label for="email" class="label">メールアドレス</label>
            <input id="email" type="email" name="email" class="text" value="{{ old('email') }}">
            @error('email')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('email')}}</p>
                </span>
            @enderror
            <label for="password" class="label">パスワード</label>
            <input id="password" type="password" name="password" class="text">
            @error('password')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('password')}}</p>
                </span>
            @enderror
            <div class="button-content">
                <button class="button-login" type="submit">ログインする</button>
                <a href="/register" class="register">会員登録はこちら</a>
            </div>
        </form>
    </main>
</body>
</html>