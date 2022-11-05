@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="container">
  <div class="row">
    <h3 class="layout">DAWNSNSへようこそ</h3>

    {{ Form::label('e-mail',) }}
    <br>
    {{ Form::text('mail',null,['class' => 'input']) }}
    <br>
    {{ Form::label('password') }}
    <br>
    {{ Form::password('password',['class' => 'input']) }}
    <br>
    {{ Form::submit('LOGIN') }}

    <p><a class="layout" href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
  </div>
</div>
@endsection
