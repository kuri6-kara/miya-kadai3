@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}" />
@endsection

@section('content')
<div class="show">
    <form action="/weight_logs/{{ $weight_log['id'] }}/update" method="POST" novalidate>
        @method('PATCH')
        @csrf
        <div class="show_title">Weight Log</div>
        <div class="form-title">
            日付
        </div>
        <div class="form-content">
            <input class="form__date" type="date" name="date" value="{{ $weight_log['date'] }}">
        </div>
        <div class="form__error">
            @error('date')
            {{ $message }}
            @enderror
        </div>

        <div class="form-title">
            体重
        </div>
        <div class="form-content">
            <input type="number" name="weight" value="{{ $weight_log['weight'] }}" />
            <p>kg</p>
        </div>
        <div class="form__error">
            @error('weight')
            {{ $message }}
            @enderror
        </div>

        <div class="form-title">
            摂取カロリー
        </div>
        <div class="form-content">
            <input type="number" name="calories" value="{{ $weight_log['calories'] }}" />
            <p>cal</p>
        </div>
        <div class="form__error">
            @error('calories')
            {{ $message }}
            @enderror
        </div>

        <div class="form-title">
            運動時間
        </div>
        <div class="form-content">
            <input type="time" name="exercise_time" value="{{ $weight_log['exercise_time'] }}" />
        </div>
        <div class="form__error">
            @error('exercise_time')
            {{ $message }}
            @enderror
        </div>

        <div class="form-title">
            運動内容
        </div>
        <div class="form-content">
            <input type="text" name="exercise_content" placeholder="運動内容を追加" value="{{ $weight_log['exercise_content'] }}" />
        </div>
        <div class="form__error">
            @error('exercise_content')
            {{ $message }}
            @enderror
        </div>

        <div class="return-form__button">
            <button type="button" onclick="location.href='/weight_logs' ">戻る</button>
        </div>
        <div class="update-form__button">
            <button type="submit">更新</button>
        </div>
    </form>

    <form class="delete-form" action="/weight_logs/{{ $weight_log }}/delete" method="POST" novalidate>
        @method('DELETE')
        @csrf
        <div class="delete-form__button">
            <input type="hidden" name="id" value="{{ $weight_log['id'] }}">
            <button class="delete-form__button-submit" type="submit">
                <img src="img/Group (2).png">
            </button>
        </div>
    </form>
</div>
@endsection