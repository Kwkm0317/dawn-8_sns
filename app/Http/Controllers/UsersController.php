<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(User $user){
        $all_users = $user->getAllUsers(Auth::user()->id);
        $login_user = Auth::user();

        return view('users.search', [
            'all_users' => $all_users,
            'login_user' => $login_user
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