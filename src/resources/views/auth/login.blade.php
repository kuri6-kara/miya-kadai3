<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <main>
        <div class="login-form__content">
            <div class="login-form__heading">
                <div class="login-form_title1">PiGLy</div>
                <div class="login-form_title2">ログイン</div>
            </div>
            <div class="login-form__inner">
                <form class="login-form__form" action="/login" method="post">
                    @csrf
                    <div class="login-form__group">
                        <span class="login-form__label">メールアドレス</span>
                        <input class="login-form__input" type="email" name="email" value="{{ old('email') }}" />
                        <div class="register-form__error-message">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="login-form__group">
                        <span class="login-form__label">パスワード</span>
                        <input class="login-form__input" type="password" name="password" />
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="login-form__btn btn" type="submit">ログイン</button>
                </form>
            </div>
            <a class="register__link" href="/register">アカウント作成はこちら</a>
        </div>
    </main>
</body>

</html>