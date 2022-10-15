<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{

    public function followList(){

        $follow_id = DB::table('follows')
        ->where('follow_id',Auth::id())
        ->pluck('follower_id'); //getだと全データ取得してしまうので、指定したカラムの情報のみ取得したいときはpluckを使う

        $users = DB::table('users') //ここはiconのimagesを持ってくるためだけにuser情報を取得している
        ->whereIn('id',$follow_id)
        ->get();

        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id') //usersとpostsのテーブルを統合して検索
        // ->where('users.id',Auth::id())
        ->whereIn('user_id',$follow_id)
        ->select('posts.posts','posts.created_at as created_at','users.username','users.images')
        ->get();


        return view('follows.followList',compact('users','posts'));
    }
    public function followerList(){
        $follower_id = DB::table('follows')
        ->where('follower_id',Auth::id())
        ->pluck('follow_id');

        $users = DB::table('users')
        ->whereIn('id',$follower_id)
        ->get();

        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->whereIn('user_id',$follower_id)
        ->select('posts.posts','posts.created_at as created_at','users.username','users.images')
        ->get();

        return view('posts.followerList',compact('users','posts'));
    }
    public function show(User $user, Post $post, Follow $follow)
    {
        $login_user = Auth::user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $timelines = $post->getUserTimeLine($user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

        return view('layouts.login', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
