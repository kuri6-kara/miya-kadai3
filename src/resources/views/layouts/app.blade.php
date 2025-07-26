<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <div class="header">
        <div class="header__left">
            PiGLy
        </div>
        <div class="header__right">
            <li class="goal-form__button">
                <button type="button" onclick="location.href='/weight_logs/goal_setting/index' ">
                    <img src="{{ asset('img/Group(3).png') }}">
                    目標体重設定
                </button>
            </li>
            <li class="logout__button">
                @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" novalidate>
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('img/Group(4).png') }}">
                        ログアウト
                    </button>
                </form>
                @endif
            </li>
        </div>
    </div>

    <main>
        <div class="admin">
            @yield('content')
        </div>
    </main>
</body>

</html>