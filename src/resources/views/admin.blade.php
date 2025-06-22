@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')

<div class="admin">
    <div class="upper_part">
        <label for="target_weight">目標体重</label>
        <input type="number" name="target_weight" value="{{ old('target_weight') }}" />

    </div>

    <div class="content1">
        <form action="/weight_logs/search" method="GET">
            @csrf
            <div>
                <input type="date" name="from" placeholder="年/月/日" value="{{ old('date') }}">
                <p>{{ "~" }}</p>
                <input type="date" name="until" placeholder="年/月/日" value="{{ old('date') }}">
            </div>
            <div>
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
                        <form action="/weight_logs/create" method="POST">
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

        <div class="content1">
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
                            <img src="img/Group.png">
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