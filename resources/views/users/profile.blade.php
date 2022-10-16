{{--  こちらがログインしている人以外のユーザープロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')
<div class="post-info">
    <div class="user">
        <div class="u-icon">
           <img src="images/{{ $user->images }}" alt="icon">
           {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">
            {{ $user->username }}
        </div>
        <div class="u-mail">
            <br>{{ $user->mail }}
        </div>
        <div class="u-pass">
            <br>{{ $user->password }}
        </div>
    </div>
</div>
@endsection
