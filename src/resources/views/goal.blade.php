@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}" />
@endsection

@section('content')
<div class="goal">
    <form action="/weight_logs/goal_setting/update" method="POST" novalidate>
        @method('PATCH') {{-- ★修正: @method('PATCH') に変更★ --}}
        @csrf
        <div class="form-title">目標体重設定</div>
        <div class="form-content">
            {{-- ★修正: name="weight" を name="target_weight" に変更★ --}}
            {{-- ★修正: value に既存の目標体重をセット。$weight_target が null の場合も考慮★ --}}
            <input type="number" name="target_weight"
                value="{{ old('target_weight', $weight_target->target_weight ?? '') }}"
                step="0.1" placeholder="例: 55.0" />
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