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
                <h1>PiGLy</h1>
                <h2>新規会員登録</h2>
                <h3>STEP2 体重データの入力</h3>
            </div>
            <form class="form" action="/weight_logs" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">現在の体重</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--number">
                            <input type="number" name="weight" value="{{ old('weight') }}" />
                        </div>
                        <p>kg</p>
                        <div class="form__error">
                            @error('weight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">目標の体重</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--number">
                            <input type="number" name="target_weight" value="{{ old('target_weight') }}" />
                        </div>
                        <p>kg</p>
                        <div class="form__error">
                            @error('target_weight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">アカウント作成</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>