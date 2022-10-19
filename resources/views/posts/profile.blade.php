{{--  こちらがログインしている人のプロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')

<div class="post-info">
    <form action="{{ route('posts.update-profile') }}" method="post">
    @csrf
        <div class="u-icon">
            <img src="images/{{ $login_user->images }}" alt="icon">
                {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <p>Name</p>
        <input type="text" name="username" value="{{ $login_user->username }}">
        <p>Bio</p>
        <input type="text" name="bio" value="{{ $login_user->bio }}">
        <p>Mail Address</p>
        <input type="text" name="mail" value="{{ $login_user->mail }}"><br>
        <p>Password</p>
        <input type="password" name="password" autocomplete="new-password"><br>

        <input type="submit" value="更新">
    </form>
</div>



@endsection
