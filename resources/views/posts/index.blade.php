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
            <img class="u-icon" src="{{ asset('/storage/upload/' .$timeline->images) }}" alt="icon">
            {{--  timelineに入っているpostテーブルのデータとuserテーブルの情報をくっつけてuserテーブルの中のimagesを表示させる  --}}
            <p class="u-name">{{ $timeline->username }}</p>
            <p class="c-time">{{ $timeline->created_at }}</@>
        </div>
    </div>
    <br>
    <p class="post">{{ $timeline->posts }}</p>
    <div class="overlay" id="js-overlay"></div>
    <div class="edit">
        <div id="js-modal" class="modal">
            <div class="upd-post modal-close__wrap">
                <div id="{{ $timeline->id }}" class="hide-area">
                    <form action="/update" method="POST">
                    @csrf
                        <input type="text" name="post" value="{{ $timeline->posts }}">
                        <input type="hidden" name="id" value="{{ $timeline->id }}">
                        <input id="js-close" class="modal-close i-icon edit" type="image" img src="images/edit.png" alt="update">
                    </form>
                </div>
            </div>
            <a href="" class="modal-open" data-target="{{ $timeline->id }}">
                <img id="js-open" class="i-icon update-icon" src="images/edit.png" alt="update">
            </a>
        </div>
        <div class="del-post">
            <form class="btn-danger" action="/delete" method="post" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')">
                @method('delete')
                @csrf
                <input type="hidden" name="delete" value="{{ $timeline->id }}">
                {{--  ↑$timelineに格納してあるidの値をdeleteという名前で送っている　 --}}
                <input class="i-icon edit" type="image" src="images/trash_h.png" alt="delete" >
            </form>

        </div>
    </div>
</div>

@endforeach


@endsection
