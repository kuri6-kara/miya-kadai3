@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}" />
@endsection

@section('content')
<div class="goal">
    <form action="/weight_logs/goal_setting" method="POST">
        @csrf
        <div class="form-title">目標体重設定</div>
        <div class="form-content">
            <input type="number" name="weight" value="{{ $weight_target['target_weight'] }}" />
            <p>kg</p>
        </div>
        <div class="form__error">
            @error('target_weight')
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
</div>
@endsection