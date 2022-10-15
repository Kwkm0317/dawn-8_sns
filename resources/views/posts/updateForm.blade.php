@extends('layouts.login')

@section('content')
<div class='container'>
    <h2 class='page-header'>投稿内容を変更する</h2>
    {!! Form::open(['url' => '/post/update']) !!}
    <div class="form-group">
        {!! Form::hidden('id', $post->id) !!}
        {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary pull-right">更新</button>
    {!! Form::close() !!}
</div>
@endsection

<form action="/post/update" method="post">
  @csrf
  <div class="form-group">
    <input type="hidden" name="id" value="{{ $post->id }}">
    <input type="text" name="upPost" value="{{ $post->post }}" required class="form-control">
  </div>
  <button type="submit" class="btn btn-primary pull-right">更新</button>
</form>
