@extends('layouts.login')

@section('content')
<h1>Follow List</h1>
@foreach ($users as $user)
    <div class="follow-icon">
        <a href="{{ route('user_profile', ['id' => $user->id]) }}">
            <img src="images/{{ $user->images }}" alt="icon">
        </a>
    </div>
@endforeach


@foreach ($posts as $post)
{{--  foreachでpostテーブルの中身を表示していく  --}}
{{--  topに表示されるpostは全ユーザー分  --}}
<div class="podt-all">
    <div class="post-info">
     <div class="user">
        <div class="u-icon">
            <img src="images/{{ $post->images }}" alt="icon">
            {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">{{ $post->username }}</div>
     </div>
        <div class="c-time">{{ $post->created_at }}</div>
    </div>
    <div class="post"><br>{{ $post->posts }}</div>
</div>

@endforeach


@endsection
