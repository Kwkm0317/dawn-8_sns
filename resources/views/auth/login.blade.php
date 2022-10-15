@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="container">
  <div class="row">
    <p>DAWNSNSへようこそ</p>

    {{ Form::label('e-mail') }}
    <br>
    {{ Form::text('mail',null,['class' => 'input']) }}
    <br>
    {{ Form::label('password') }}
    <br>
    {{ Form::password('password',['class' => 'input']) }}
    <br>
    {{ Form::submit('ログイン') }}

    <p><a href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
  </div>
</div>
@endsection
