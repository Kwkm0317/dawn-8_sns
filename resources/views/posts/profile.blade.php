{{--  こちらがログインしている人のプロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')

<div class="post-info">
    <div class="user">
        <div class="u-icon">
           <img src="images/{{ $login_user->images }}" alt="icon">
           {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
    </div>
    <form action="{{ route('posts.profile') }}" method="post">
    @csrf
        <input type="hidden" name="id" value="{{ $login_user->id }}">
        <p>Name</p>
        <input type="text" name="name" value="{{ $login_user->username }}">
        <p>Bio</p>
        <input type="text" name="bio" value="{{ $login_user->bio }}">
        <p>Mail Address</p>
        <input type="text" name="mail" value="{{ $login_user->mail }}"><br>

        <input type="submit" value="更新">
    </form>
</div>



@endsection
