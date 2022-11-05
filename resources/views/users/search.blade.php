@extends('layouts.login')

@section('content')
{{--  <h2>機能を実装していきましょう。</h2>  --}}
<form action="{{ route('users.search') }}" method="post">
    @csrf
    <input class="search-form" type="search" placeholder="ユーザー名" name="word" value="{{ $word }}">
    <input class="search-icon" type="image" src="images/search_icon.png" alt="search_icon" width="35px" height="35px">
    {{--  <button type="submit">検索</button>  --}}
</form>
@if(empty($word))
    @foreach ($all_users as $user)
    <table>
        <tr>
            <td class="u-icon">
                <a href="{{ route('user_profile', ['id' => $user->id]) }}">
                    <img class="u-icon" src="{{ asset('/storage/upload/' .$user->images) }}" alt="icon">
                </a>
            </td>
            <td class="u-name">　{{$user->username}}　</td>
            <td>
                @if($login_user->isFollowing($user->id))
                    <form action="{{ route('un_follow', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-danger2">フォロー解除</button>
                    </form>
                @else
                <form action="{{ route('follow', ['id' => $user->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn-danger1">フォローする</button>
                </form>

                @endif
            </td>
        </tr>
    </table>
    @endforeach
@else
    @foreach ($search as $user)
    <table>
        <tr>
            <td class="u-icon">
                <img class="u-icon" src="{{ asset('/storage/upload/' .$user->images) }}" alt="icon">
            </td>
            <td class="u-name">　{{$user->username}}　</td>
            <td>
                @if($login_user->isFollowing($user->id))
                    <form action="{{ route('un_follow', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-danger2">フォロー解除</button>
                    </form>
                @else
                <form action="{{ route('follow', ['id' => $user->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn-danger1">フォローする</button>
                </form>

                @endif
            </td>
        </tr>
    </table>
    @endforeach

@endif

@endsection
