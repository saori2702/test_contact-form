<!-- レイアウト -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <nav class="header__nav">
                @if(Request::is('login'))
                    <a href="/register" class="header-button">register</a>

                @elseif(Request::is('register'))
                    <a href="/login" class="header-button">login</a>

                @elseif(Request::is('admin'))
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="header-button">
                            logout
                        </button>
                    </form>
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>