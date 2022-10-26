{{--  こちらがログインしている人以外のユーザープロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')
    <div class="follow-user">
        <div class="u-icon">
           <img class="u-icon" src="{{ asset('/storage/upload/' .$users->images) }}" alt="icon">
           {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">Name　
            {{ $users->username }}
        </div>
        <div class="u-bio">Bio　
            {{ $users->bio }}
        </div>
        <div class="follow">
            @if($login_user->isFollowing($users->id))
                <form action="{{ route('un_follow', ['id' => $users->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-danger2">フォロー解除</button>
                </form>
            @else
            <form action="{{ route('follow', ['id' => $users->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn-danger1">フォローする</button>
            </form>

            @endif
        </div>
    </div>

@foreach ($posts as $post)
{{--  foreachでpostテーブルの中身を表示していく  --}}
{{--  topに表示されるpostは全ユーザー分  --}}
<div class="podt-all">
     <div class="user">
        <div class="u-icon">
            <img class="u-icon" src="{{ asset('/storage/upload/' .$post->images ) }}" alt="icon">
            {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <p class="u-name">{{ $post->username }}</p>
        <p class="c-time">{{ $post->created_at }}</p>
    </div>

    <p class="post"><br>{{ $post->posts }}</p>
</div>

@endforeach

@endsection
