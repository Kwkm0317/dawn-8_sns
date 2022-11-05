<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;

class UsersController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    public function profile($id){
        $login_user = Auth::user();

        $users = DB::table('users')
            ->where('id', $id)
            ->first(); //一つだけ持ってくる

        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->where('user_id',$id)
            ->select('posts.posts','posts.created_at as created_at','users.username','users.images')
            ->get();


        return view('users.profile', compact('login_user', 'posts', 'users'));
    }
    // 検索機能
    public function search(Request $request, User $user){
        $all_users = $user->getAllUsers(Auth::user()->id);
        $login_user = Auth::user();

        $word = $request->input('word');
        $user = DB::table('users');

        if(!empty($word)) {
            $user->where('username', 'LIKE', "%{$word}%");
        }

        $search = $user->get();

        return view('users.search', [
            'all_users' => $all_users,
            'login_user' => $login_user,
            'search' => $search,
            'word' => $word
            ]);
    }


    //フォロー
    public function follow($id){
        $follower = Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($id);
            return back();
        }
    }


    //フォロー解除
    public function unFollow($id){
        $follower = Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unFollow($id);
            return back();
        }
    }

}
