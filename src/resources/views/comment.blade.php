@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}" />
@endsection

@section('content')
<div class="comment">
    <form action="/weight_logs/{{ $weight_log->id }}/comments" method="POST" novalidate>
        @csrf
        <div class="comment_title">Weight Log</div>

        <div class="comment-info-container">
            <div class="comment-date__label">日付: {{ $weight_log->date }}</div>
            <div class="comment-weight__label">体重: {{ $weight_log->weight }}kg</div>
        </div>

        <div class="comment-input-container">
            <div class="comment-content">
                <div class="comment-content__title">コメント</div>
                <textarea name="comment" placeholder="コメントを記入">{{ old('comment') }}</textarea>
                @error('comment')
                <div class="form__error">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="comment-form_button">
                <div class="send-form__button">
                    <button type="submit">送信</button>
                </div>
                <div class="return-form__button">
                    <button type="button" onclick="location.href='/weight_logs' ">戻る</button>
                </div>
            </div>
        </div>
    </form>

    <div class="comment-history-title">
        コメント一覧
    </div>
    @foreach ($weight_log->comment as $comment)
    <div class="comment-display-container">
        <div class="comment-display-item">
            <p class="comment-display-user">
                {{-- ユーザー名が存在すれば表示、なければ「名無しさん」と表示 --}}
                {{ $comment->user->name ?? '名無しさん' }}
            </p>
            <p class="comment-display-text">{{ $comment->comment }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection