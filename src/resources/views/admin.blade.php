@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')

<div class="upper_part">
    {{-- 新しい表示形式 --}}
    <div class="weight-summary">
        <span>
            目標体重:
            {{ $weight_targets->target_weight ?? '未設定' }}kg
        </span>

        <span class="separator">｜</span>

        <span>
            目標まで:
            @if ($weight_difference !== null)
            @if ($weight_difference > 0)
            <span style="color: red;">+{{ $weight_difference }}kg</span>
            @elseif ($weight_difference < 0)
                <span style="color: green;">-{{ abs($weight_difference) }}kg</span>
        @else
        0kg
        @endif
        @else
        計算不可
        @endif
        </span>

        <span class="separator">｜</span>

        <span>
            最新体重:
            {{ $current_weight ?? '未登録' }}kg
        </span>
    </div>
</div>



<div class="content">

    <div class="form1">

        <form action="/weight_logs/search" method="GET" class="search-form" novalidate>

            @csrf

            <div class="search-start__date">

                <input type="date" class="date" name="start_date" placeholder="年/月/日" value="{{ request('date') }}">

                <img src="{{ asset('img/Polygon 2.png') }}" alt="アイコン">

            </div>

            <p>{{ "~" }}</p>

            <div class="search-end__date">

                <input type="date" class="date" name="end_date" placeholder="年/月/日" value="{{ request('date') }}">

                <img src="{{ asset('img/Polygon 2.png') }}" alt="アイコン">

            </div>

            <div class="form-btn">

                <input class="search-form__search-btn btn" type="submit" value="検索">

                <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">

            </div>

        </form>



        <div class="create-form__button">

            <label class="btn-submit" for="modal-toggle">データを追加</label>

            @if ($errors->any())

            <input class="modal-toggle" type="checkbox" id="modal-toggle" hidden checked>

            @else

            <input class="modal-toggle" type="checkbox" id="modal-toggle" hidden>

            @endif

            <div class="modal" id="weightLogModal">

                <label for="modal-toggle" class="modal-overlay"></label>

                <div class="modal__inner">

                    <div class="modal_content">

                        <form action="/weight_logs/create" method="POST" novalidate>

                            @csrf

                            <div class="modal_form-item">

                                <div class="form-title">

                                    <span class="form--item">日付</span>

                                    <span class="form--required">必須</span>

                                </div>

                                <div class="form-content">

                                    <input class="modal-form__date" type="date" name="date" value="{{ old('date') }}">

                                </div>

                                <div class="form__error">

                                    @error('date')

                                    {{ $message }}

                                    @enderror

                                </div>



                                <div class="form-title">

                                    <span class="form--item">体重</span>

                                    <span class="form--required">必須</span>

                                </div>

                                <div class="form-content">

                                    <input type="number" name="weight" placeholder="50.0" value="{{ old('price') }}" />

                                    <p>kg</p>

                                </div>

                                <div class="form__error">

                                    @error('weight')

                                    {{ $message }}

                                    @enderror

                                </div>



                                <div class="form-title">

                                    <span class="form--item">摂取カロリー</span>

                                    <span class="form--required">必須</span>

                                </div>

                                <div class="form-content">

                                    <input type="number" name="calories" placeholder="1200" value="{{ old('calories') }}" />

                                    <p>cal</p>

                                </div>

                                <div class="form__error">

                                    @error('calories')

                                    {{ $message }}

                                    @enderror

                                </div>



                                <div class="form-title">

                                    <span class="form--item">運動時間</span>

                                    <span class="form--required">必須</span>

                                </div>

                                <div class="form-content">

                                    <input type="time" name="exercise_time" placeholder="00:00" value="{{ old('exercise_time') }}" />

                                </div>

                                <div class="form__error">

                                    @error('exercise_time')

                                    {{ $message }}

                                    @enderror

                                </div>



                                <div class="form-title">

                                    <span class="form--item">運動内容</span>

                                </div>

                                <div class="form-content">

                                    <input type="text" name="exercise_content" placeholder="運動内容を追加" value="{{ old('exercise_content') }}" />

                                </div>

                                <div class="form__error">

                                    @error('exercise_content')

                                    {{ $message }}

                                    @enderror

                                </div>



                                <div class="return-form__button">

                                    <button type="button" onclick="location.href='/weight_logs' ">戻る</button>

                                </div>

                                <div class="register-form__button">

                                    <button type="submit">登録</button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="form2">

        <table class="form-content">

            <tr class="admin__row">

                <th class="admin__label">日付</th>

                <th class="admin__label">体重</th>

                <th class="admin__label">食事摂取カロリー</th>

                <th class="admin__label">運動時間</th>

                <th class="admin__label"></th>

            </tr>

            @foreach($weight_logs as $weight_log)

            <tr class="admin__row">

                <td class="admin__data">{{$weight_log->date}}</td>

                <td class="admin__data">{{$weight_log->weight}}</td>

                <td class="admin__data">{{$weight_log->calories}}</td>

                <td class="admin__data">{{$weight_log->exercise_time}}</td>

                <td class="admin__data">

                    <a href="/weight_logs/{{$weight_log->id}}">

                        <img src="{{ asset('img/Group.png') }}">

                    </a>

                </td>

            </tr>





            @endforeach

        </table>

        <div class="pagination-content">

            {{ $weight_logs->links('vendor.pagination.semantic-ui') }}

        </div>

    </div>

</div>

@endsection