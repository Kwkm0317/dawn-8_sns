{{--  こちらがログインしている人のプロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')

<div class="post-info">
    <form action="{{ route('posts.update-profile') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="u-icon">
            <img src="{{ asset('/storage/upload/' . $login_user->images) }}" alt="icon">
            {{--  <input type="submit" value="アップロード">  --}}
                {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <p>Name</p>
        <input type="text" name="username" value="{{ $login_user->username }}"><br>
        <p>Mail Address</p>
        <input type="text" name="mail" value="{{ $login_user->mail }}"><br>
        <p>Password</p>
        <input type="password" value="{{ $login_user->password }}" disabled="disabled" />
        <p>new Password</p>
        <input type="password" name="password" autocomplete="new-password"><br>
        <p>Bio</p>
        <input type="text" name="bio" value="{{ $login_user->bio }}"><br>
        <p>Icon Image</p>
        <input type="file" name="users_icon"><br><br>


        <input type="submit" value="更新">
    </form>
</div>

<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

@endsection
