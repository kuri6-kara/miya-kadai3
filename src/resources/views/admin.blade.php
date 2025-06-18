@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<form action="/weight_logs/search" method="GET">
    @csrf
    <div>
        <input type="date" name="from" placeholder="年/月/日" value="{{ $date }}">
        <span class="">~</span>
        <input type="date" name="until" placeholder="年/月/日" value="{{ $date }}">
    </div>
    <div>
        <input class="search-form__search-btn btn" type="submit" value="検索">
        <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
    </div>
</form>

@endsection