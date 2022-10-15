@extends('layouts.login')

@section('content')
{{--  <h2>機能を実装していきましょう。</h2>  --}}

<form class="post-form" action="{{ route('posts.store') }}" method="POST">
  @csrf
  <input class="tweet" type="text" name="text" placeholder="何をつぶやこうか...?">
  <button class="post-img" type="submit">
    <img src="images/post.png" alt="post">
  </button>
</form>

@foreach ($timelines as $timeline)
{{--  foreachでpostテーブルの中身を表示していく  --}}
{{--  topに表示されるpostは全ユーザー分  --}}
<div class="podt-all">
    <div class="post-info">
     <div class="user">
        <div class="u-icon">
            <img src="images/{{ $timeline->images }}" alt="icon">
            {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
        </div>
        <div class="u-name">{{ $timeline->username }}</div>
     </div>
        <div class="c-time">{{ $timeline->created_at }}</div>
    </div>
    <div class="post"><br>{{ $timeline->posts }}</div>
     <div class="upd-post">
      <a href="" class="modalopen" data-target="{{ $timeline->id }}">
        <img src="images/edit.png" alt="update">
      </a>
       <div id="{{ $timeline->id }}" class="hide-area">
        <form action="/update" method="POST">
        @csrf
            <input type="text" name="post" value="{{ $timeline->posts }}">
            <input type="hidden" name="id" value="{{ $timeline->id }}">
            <input type="image" img src="images/edit.png" alt="update">
        </form>
      </div>
     </div>
    <div class="del-post">
        <form class="btn-danger" action="/delete" method="post" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')">
            @method('delete')
            @csrf
            <input type="hidden" name="delete" value="{{ $timeline->id }}">
            {{--  ↑$timelineに格納してあるidの値をdeleteという名前で送っている　 --}}
            <input type="image" src="images/trash_h.png" alt="delete">
        </form>

    </div>
</div>

@endforeach


@endsection