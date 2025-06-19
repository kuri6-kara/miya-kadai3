@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')

<div class="upper_part">
    <label for="target_weight">目標体重</label>
    <input type="number" name="target_weight" value="{{ old('target_weight') }}" />

</div>

<div class="content1">
    <form action="/weight_logs/search" method="GET">
        @csrf
        <div>
            <input type="date" name="from" placeholder="年/月/日" value="{{ $date }}">
            <p>{{ "~" }}</p>
            <input type="date" name="until" placeholder="年/月/日" value="{{ $date }}">
        </div>
        <div>
            <input class="search-form__search-btn btn" type="submit" value="検索">
            <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
        </div>
    </form>

    <div class="create-form__button">
        <button type="button" onclick="location.href='/weight_logs/create' ">データ追加</button>
    </div>
</div>

<table class="content2">
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
            <a href="#{{$weight_log->id}}">
                <img src="img/Group.png">
            </a>
        </td>
    </tr>
</table>





@endsection