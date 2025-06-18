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
    <div class="app">
        <header class="header">
            <h1 class="header__title">
                PiGLy
            </h1>
            <li class="change-form__button">
                <button type="button" onclick="location.href='/weight_logs/goal_setting' ">目標体重設定</button>
            </li>
            <li class="logout__button">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            </li>
        </header>
    </div>

    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
</body>

</html>