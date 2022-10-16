<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use Illuminate\Support\Facades\Validator, DB;

class PostsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = Auth::user();

        $follow_id = DB::table('follows')
        ->where('follow_id',Auth::id())
        ->pluck('follower_id'); //getだと全データ取得してしまうので、指定したカラムの情報のみ取得したいときはpluckを使う

        $timelines = DB::table('posts')
        ->join('users','posts.user_id','=','users.id') //usersとpostsのテーブルを統合して検索
        ->where('user_id',$user->id)
        ->orWhereIn('user_id',$follow_id)
        ->select('posts.id', 'posts.user_id', 'posts.posts','posts.created_at as created_at','users.username','users.images')
        ->get();

        // $timelines = $post->getUserTimeLine($user->id);
        return view('posts.index', [
            'user' => $user,
            'timelines' => $timelines
        ]);
    }

    // public function followList(Post $post){
    //     $user = Auth::user();
    //     $follow_users = $post->getUserTimeLine($user->id);
    //     return view('follows.followList', [
    //         'user' => $user,
    //         'follow_users' => $follow_users
    //     ]);

    // }

    // public function followerList(Post $post){
    //     $user = Auth::user();
    //     $follower_users = $post->getUserTimeLine($user->id);
    //     return view('posts.followerList', [
    //         'user' => $user,
    //         'follower_users' => $follower_users
    //     ]);
    // }

    public function create(){
        $user = Auth::user();

        return view('posts.create',[
            'user' => $user
        ]);
    }

    public function store(Request $request, Post $post){
        $user = Auth::user();
        $data = $request->all();
        $validator = Validator::make($data,[
            'text' => ['required', 'string', 'max:150'],
            ['text.required' => '入力してください']
        ]);

        $validator->validate();
        // $post->postStore($user->id, $data);
        // これでもできるよ↓↓
        DB::table('posts')
            ->insert([
                'user_id' => $user->id,
                'posts' => $data['text'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect('/top');
    }

    public function delete(Request $request){
        $delete = $request->delete;
        DB::table('posts')
            ->where('id', $delete)
            ->delete();
        return redirect('/top');
    }

    public function update(Request $request){
        $up_id = $request->input('id');
        $up_post = $request->input('post');
            DB::table('posts')
            ->where('id', $up_id)
            ->update(
                ['posts' => $up_post]
            );
        return redirect('/top');
    }

    // ログインしている人のプロフィールを表示させるためのところ
    public function profile(){
        $login_user = Auth::user();
        $update = DB::table('users')
        ->where('id', $login_user->id)
        ->update([
            'username' => $login_user['username'],
            'mail' => $login_user['mail']
        ]);

        return view('posts.profile', [
            'login_user' => $login_user,
            'update' => $update
        ]);
    }

}
