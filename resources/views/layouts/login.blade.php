<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1 class="top">
                <a href="/top"><img class="main-logo" src="{{ asset('images/main_logo.png') }}"></a>
            </h1>
                <div class="gnav">
                    <ul class="gnav-contents">
                    <li class="menu">
                        {{-- relativeを --}}
                        <div class="user_menu">
                            {{$user->username}}さん
                            <div class="openbtn2"><span></span><span></span></div>
                            <img class="u-icon" src="{{ asset('/storage/upload/'.$user->images ) }}">
                        </div>
                    {{-- $userをPostsControllerのindexで定義してしまってveiwではそれを表示させるだけの方がいい --}}
                    <ul class="dropdown-menu">
                        {{-- absoluteをつける --}}
                        <li class="panel_item"><a class="panel_item" href="/top">Home</a></li>
                        <li class="panel_item"><a class="panel_item" href="/user_profile">プロフィール編集</a></li>
                        <li class="panel_item"><a class="panel_item" href="/logout">ログアウト</a></li>
                    </ul>
                    </li>
                </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p class="follower">{{$user->username}}さんの</p>
                <div>
                <p class="follower">　フォロー数　　　{{$follow_count}}名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <p class="follower">　フォロワー数　　{{$follower_count}}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                {{--  レビュー用ボタン  --}}
                <p class="btn btn_test"><a href="/test">ユーザーのつぶやき一覧</a></p>
            </div>
            <p class="search-btn btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset ('js/script.js') }}"></script>
</body>
</html>
