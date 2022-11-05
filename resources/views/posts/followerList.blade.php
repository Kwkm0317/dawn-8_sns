@extends('layouts.login')

@section('content')
<div class="f-icon">
    <h1 class="f-list">Follower List</h1>
    @foreach ($posts->unique('id') as $user)
        <a href="{{ route('user_profile', ['id' => $user->id]) }}">
            <img class="u-icon" src="{{ asset('/storage/upload/' .$user->images) }}" alt="icon">
        </a>
    @endforeach
</div>

@foreach ($posts as $post)
{{--  foreachでpostテーブルの中身を表示していく  --}}
{{--  topに表示されるpostは全ユーザー分  --}}
<div class="podt-all">
    <div class="user">
        <img class="u-icon" src="{{ asset('/storage/upload/' .$post->images) }}" alt="icon">
        {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        <p class="u-name">{{ $post->username }}</p>
        <p class="c-time">{{ $post->created_at }}</p>
    </div>
    <p class="post"><br>{{ $post->posts }}</p>
</div>

@endforeach


@endsection
