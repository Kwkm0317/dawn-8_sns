{{--  こちらがログインしている人以外のユーザープロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')
<div class="post-info">
    <div class="user">
        <div class="u-icon">
           <img src="images/{{ $users->images }}" alt="icon">
           {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">
            {{ $users->username }}
        </div>
        <div class="u-mail">
            <br>{{ $users->bio }}
        </div>
    </div>
</div>

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
