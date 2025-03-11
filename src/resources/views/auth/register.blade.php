<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録画面</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <img src="{{ asset('images/logo.svg') }}" alt="coachtech">
        </div>
    </header>
    <main class="contents">
        <h1>会員登録</h1>
        <form action="/register" method="post">
        @csrf
            <label for="name" class="label">ユーザー名</label>
            <input id="name" type="text" name="name" class="text" value="{{ old('name') }}">
            @error('name')
                <span class="input_error">
                    <p class="input_error_message">{{$errors->first('name')}}</p>
                </span>
            @enderror
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
            <label for="password_confirmation" class="label">確認用パスワード</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="text">
            <div class="button-content">
                <button class="button-register" type="submit">登録する</button>
                <a href="/login" class="login">ログインはこちら</a>
            </div>
        </form>
    </main>
</body>
</html>