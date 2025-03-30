<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-left">
                <a href="/"><img src="{{ asset('images/logo.svg') }}" alt="coachtech" class="header-logo"></a>
            </div>
            @if(request()->path() != 'login' && request()->path() != 'register')
            <div class="header-right">
                <div class="keyword-content">
                    <form action="/">
                        <input type="text" class="keyword" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
                    </form>
                </div>
                <form action="/logout" method="post">
                    @csrf
                <input id="drawer_input" class="drawer_hidden" type="checkbox">
                <label for="drawer_input" class="drawer_open"><span></span></label>
                <nav class="header-nav">
                    <ul class="header-nav-list">
                        @guest
                        <li class="header-nav-item"><a href="/login" class="login-link">ログイン</a></li>
                        @endguest
                        @auth
                        <li class="header-nav-item"><button class="logout-link">ログアウト</button></li>
                        @endauth
                        <li class="header-nav-item"><a href="/mypage" class="mypage-link">マイページ</a></li>
                        <li class="header-nav-item"><a href="/sell" class="sell-link">出品</a></li>
                    </ul>
                </nav>
                </form>
            </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('script')
    @yield('style')
</body>
</html>