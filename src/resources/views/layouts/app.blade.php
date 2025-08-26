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
            <div class="header__title">PiGLy</div>
        </div>
        <div class="header__right">
            <li class="goal-form__button">
                <button type="button" onclick="location.href='/weight_logs/goal_setting/index' ">
                    <img src="{{ asset('img/target_weight.png') }}">
                    目標体重設定
                </button>
            </li>
            <li class="logout__button">
                @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" novalidate>
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('img/logout.png') }}">
                        ログアウト
                    </button>
                </form>
                @endif
            </li>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
</body>

</html>