<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register_step2.css') }}" />
</head>

<body>
    <main>
        <div class="register-form__content">
            <div class="register-form__heading">
                <div class="register-form_title1">PiGLy</div>
                <div class="register-form_title2">新規会員登録</div>
            </div>
            <div class="register-form_title3">STEP2 体重データの入力</div>
            <div class="register-form__inner">
                <form class="register-form__form" action="/register/step2" method="post" novalidate>
                    @csrf
                    <div class="register-form__group">
                        <span class="register-form__label">現在の体重</span>
                        <div class="input-with-unit">
                            <input class="form__input--number" type="number" name="weight" value="{{ old('weight') }}" />
                            <span class="unit">kg</span>
                        </div>
                        <div class="register-form__error-message">
                            @error('weight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="register-form__group">
                        <span class="register-form__label">目標の体重</span>
                        <div class="input-with-unit">
                            <input class="form__input--number" type="number" name="target_weight" value="{{ old('target_weight') }}" />
                            <span class="unit">kg</span>
                        </div>
                        <div class="register-form__error-message">
                            @error('target_weight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button class="register-form__btn" type="submit">アカウント作成</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>