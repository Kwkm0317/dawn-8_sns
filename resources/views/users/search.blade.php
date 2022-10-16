@extends('layouts.login')

@section('content')
{{--  <h2>機能を実装していきましょう。</h2>  --}}
<form action="{{ route('users.search') }}" method="post">
    @csrf
    <input type="search" placeholder="ユーザー名" name="word" value="{{ $word }}">
    <button type="submit">検索</button>
</form>

@foreach ($all_users as $user)

<table>
    <tr>
        <td class="u-icon">
            <img src="images/{{ $user->images }}" alt="icon">
        </td>
        <td class="u-name">{{$user->username}}</td>
        <td>
            @if($login_user->isFollowing($user->id))
                <form action="{{ route('un_follow', ['id' => $user->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-danger">フォロー解除</button>
                </form>
            @else
            <form action="{{ route('follow', ['id' => $user->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn-danger">フォローする</button>
            </form>

            @endif
        </td>
    </tr>
</table>

@endforeach

@endsection
