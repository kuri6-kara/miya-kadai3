<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register_step1.css') }}" />
</head>

<body>
    <main>
        <div class="register-form__content">
            <div class="register-form__heading">
                <div class="register-form_title1">PiGLy</div>
                <div class="register-form_title2">新規会員登録</div>
            </div>
            <div class="register-form_title3">STEP1 アカウント情報の登録</div>
            <div class="register-form__inner">
                <form class="register-form__form" action="/register" method="post" novalidate>
                    @csrf
                    <div class="register-form__group">
                        <span class="register-form__label">お名前</span>
                        <input class="register-form__input" type="text" name="name" value="{{ old('name') }}" />
                        <div class="register-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="register-form__group">
                        <span class="register-form__label">メールアドレス</span>
                        <input class="register-form__input" type="email" name="email" value="{{ old('email') }}" />
                        <div class="register-form__error-message">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="register-form__group">
                        <span class="register-form__label">パスワード</span>
                        <input class="register-form__input" type="password" name="password" />
                        <div class="register-form__error-message">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="register-form__btn" type="submit">次に進む</button>
                </form>
            </div>
            <a class="login__link" href="/login">ログインはこちら</a>
        </div>
    </main>
</body>

</html>