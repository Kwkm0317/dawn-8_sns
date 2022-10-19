{{--  こちらがログインしている人以外のユーザープロフィールを表示させるview  --}}
@extends('layouts.login')

@section('content')
<div class="post-info">
    <div class="user">
        <div class="u-icon">
           <img src="{{ asset('images/' .$users->images) }}" alt="icon">
           {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">
            {{ $users->username }}
        </div>
        <div class="u-bio">
            <br>{{ $users->bio }}
        </div>
        <div>
            @if($login_user->isFollowing($users->id))
                <form action="{{ route('un_follow', ['id' => $users->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-danger">フォロー解除</button>
                </form>
            @else
            <form action="{{ route('follow', ['id' => $users->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn-danger">フォローする</button>
            </form>

            @endif
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
            <img src="{{ asset('images/' .$post->images ) }}" alt="icon">
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
