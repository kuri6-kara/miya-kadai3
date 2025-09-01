@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}" />
@endsection

@section('content')
<div class="comment">
    {{-- PATCHメソッドを使うように変更 --}}
    <form action="/weight_logs/{{ $weight_log->id }}/comments" method="POST" novalidate>
        @method('PATCH')
        @csrf
        <div class="comment_title">Weight Log</div>

        <div class="comment-content">
            <label class="comment-date__label" for="">{{ $weight_log->date }}</label>
        </div>

        <div class="form-content">
            <label class="comment-weight__label" for="">{{ $weight_log->weight }}kg</label>
        </div>


        <div class="comment-title2">
            コメント
        </div>
        <div class="comment-content">
            {{-- `old`ヘルパーと`comment`変数を組み合わせて表示 --}}
            <textarea name="comment" placeholder="コメントを記入">{{ old('comment', $comment->comment ?? '') }}</textarea>
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
    </form>

    @foreach ($comments as $comment)
    <tr class="comment-table__row">
        <td class="comment-table__item">
            <form class="update-form">
                <div class="update-form__item">
                    <p class="update-form__item-input">{{ $comment['comment'] }}</p>
                </div>
            </form>
        </td>
    </tr>
    @endforeach


</div>
@endsection