@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="row">
<h2 class="layout">新規ユーザー登録</h2>


<h3 class="">{{ Form::label('UserName') }}</h3>
{{ Form::text('username',null,['class' => 'input', 'placeholder' => 'dawntown']) }}
@if($errors->has('username')) {{-- エラーが$errorsに入る。'username'のエラー文があれば持ってきて表示するよ --}}
<div class="error">
<p>{{ $errors->first('username') }}</p>
</div>
@endif

<h3>{{ Form::label('MailAddress') }}</h3>
{{ Form::email('mail',null,['class' => 'input', 'placeholder' => 'dawn@dawn.jp']) }}
@if($errors->has('mail')) {{-- エラーが$errorsに入る。'mail'のエラー文があれば持ってきて表示するよ --}}
<div class="error">
<p>{{ $errors->first('mail') }}</p>
</div>
@endif


<h3>{{ Form::label('Password') }}</h3>
{{ Form::password('password',null,['class' => 'input']) }}
@if($errors->has('password')) {{-- エラーが$errorsに入る。のエラー文があれば持ってきて表示するよ --}}
<div class="error">
<p>{{ $errors->first('password') }}</p>
</div>
@endif

<h3>{{ Form::label('Password confirm') }}</h3>
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
@if($errors->has('password_confirmation')) {{-- エラーが$errorsに入る。のエラー文があれば持ってきて表示するよ --}}
<div class="error">
<p>{{ $errors->first('password_confirmation') }}</p>
</div>
@endif

<div>
z</div>
<p><a class="layout" href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}
</div>

@endsection
