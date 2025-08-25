@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
<link rel="stylesheet" href="{{ asset('css/modal.css') }}" />
@endsection

@section('content')
<div class="admin"> {{-- このdivを追加 --}}
    <div class="weight-summary">
        <div>
            <div class="weight-summary__title">
                目標体重
            </div>
            <div class="weight-summary__content">
                {{ $weight_targets->target_weight ?? '未設定' }}kg
            </div>
        </div>

        <div class="separator">｜</div>

        <div>
            <div class="weight-summary__title">
                目標まで
            </div>
            <div class="weight-summary__content">
                @if ($weight_difference >= 0)
                +{{ $weight_difference }}kg
                @elseif ($weight_difference < 0)
                    {{ $weight_difference }}kg
                    @endif
                    </div>
            </div>

            <div class="separator">｜</div>

            <div>
                <div class="weight-summary__title">
                    最新体重
                </div>
                <div class="weight-summary__content">
                    {{ $current_weight ?? '未登録' }}kg
                </div>
            </div>
        </div>


        <div class="content">
            <div class="form1">
                <form action="/weight_logs" method="GET" class="search-form" novalidate>
                    @csrf
                    <div class="search-start__date">
                        {{-- value属性を request('start_date') に変更して、検索後も日付が保持されるようにする --}}
                        <input type="date" class="date" name="start_date" placeholder="年/月/日" value="{{ request('start_date') }}">
                    </div>
                    <p>{{ "~" }}</p>
                    <div class="search-end__date">
                        {{-- value属性を request('end_date') に変更して、検索後も日付が保持されるようにする --}}
                        <input type="date" class="date" name="end_date" placeholder="年/月/日" value="{{ request('end_date') }}">
                    </div>
                    <div class="form-btn">
                        <input class="search-form__search-btn btn" type="submit" value="検索">
                        {{-- 検索が行われた場合にのみリセットボタンを表示 --}}
                        @if (isset($search_performed) && $search_performed)
                        <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
                        @endif
                    </div>
                </form>


                <!-- モーダルを開くボタン -->
                <div class="create-form__button">
                    <button class="btn-submit" onclick="openModal('myModal')">データを追加</button>
                </div>
                <!-- モーダル本体。デフォルトでは非表示にしている -->
                <div id="myModal" class="modal-background">
                    <div class="modal-content">
                        <!-- 閉じるボタン -->
                        <span class="modal-close" onclick="closeModal('myModal')">✖︎</span>
                        <form action="/weight_logs/create" method="POST" novalidate>
                            @csrf
                            <div class="modal_form-item">
                                <div class="modal_title">Weight Logを追加</div>
                                <div class="modal_content1">
                                    <div class="form-title">
                                        <span class="form--item">日付</span>
                                        <span class="form--required">必須</span>
                                    </div>
                                    <div class="form-content">
                                        <input class="modal-form__date" type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                                    </div>
                                    <div class="form__error">
                                        @error('date')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_content2">
                                    <div class="form-title">
                                        <span class="form--item">体重</span>
                                        <span class="form--required">必須</span>
                                    </div>
                                    <div class="form-content">
                                        <input type="number" name="weight" placeholder="50.0" value="{{ old('weight') }}" step="0.1" />
                                        <p>kg</p>
                                    </div>
                                    <div class="form__error">
                                        @error('weight')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_content3">
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
                                </div>

                                <div class="modal_content4">
                                    <div class="form-title">
                                        <span class="form--item">運動時間</span>
                                        <span class="form--required">必須</span>
                                    </div>
                                    <div class="form-content">
                                        <input type="time" name="exercise_time" placeholder="00:00" value="{{ old('exercise_time') ?? '00:00' }}" />
                                    </div>
                                    <div class="form__error">
                                        @error('exercise_time')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_content5">
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
                <script src="{{ asset('js/modal.js') }}"></script>
            </div>


            {{-- 検索結果の表示（件数と条件） --}}
            @if (isset($search_performed) && $search_performed)
            <div class="search-results-summary">
                @if ($start_date && $end_date)
                <p>{{ $start_date }} 〜 {{ $end_date }} の検索結果 {{ $search_count }}件</p>
                @elseif ($start_date)
                <p>{{ $start_date }} 以降の検索結果 {{ $search_count }}件</p>
                @elseif ($end_date)
                <p>{{ $end_date }} までの検索結果 {{ $search_count }}件</p>
                @else
                <p>全期間の検索結果 {{ $search_count }}件</p>
                @endif
            </div>
            @endif

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
    </div>
</div> {{-- このdivを閉じる --}}
@endsection