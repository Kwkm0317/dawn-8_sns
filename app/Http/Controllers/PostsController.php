<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use Illuminate\Support\Facades\Validator, DB;

class PostsController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
            ->orderBy('posts.created_at', 'desc')
            ->get();

        // $timelines = $post->getUserTimeLine($user->id);
        return view('posts.index', [
            // 'user' => $user,
            'timelines' => $timelines
        ]);
    }


    public function create(){
        $user = Auth::user();

        return view('posts.create',[
            'user' => $user
        ]);
    }

    public function store(Request $request){
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
    // getとpostで分けたほうがいい → わける
    public function profile()
    {
        $login_user = Auth::user();
        return view('posts.profile', [
            'login_user' => $login_user,
        ]);
    }

    public function updateProfile(Request $request){
        $login_user = Auth::user();

        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255',
        ],
        [
            'username.required' => '必須項目です',
            'mail.required' => '必須項目です',
            'mail.email' => 'メールアドレスではありません',
        ]);
        $validator->validate();


        DB::table('users')
            ->where('id', $login_user->id)
            ->update([
                'username' => $request->input('username'),
                'bio' => $request->input('bio'),
                'mail' => $request->input('mail'),
        ]);
        if (!empty($request->input('password'))) {
            DB::table('users')
                ->where('id', $login_user->id)
                ->update([
                    'password' => bcrypt($request->input('password'))
            ]);
        }

        if (!empty($request->file('users_icon'))) {
            $img_name = $request->file('users_icon')->getClientOriginalName();
            $request->file('users_icon')->storeAs('public/upload', $img_name);
            DB::table('users')
                ->where('id', $login_user->id)
                ->update([
                    'images' => $img_name
            ]);
        }
        return back();
    }

    public function test(){
        $user = Auth::user();

        $timelines = DB::table('posts')
            ->join('users','posts.user_id','=','users.id') //usersとpostsのテーブルを統合して検索
            ->where('user_id',$user->id)
            ->select('posts.id', 'posts.user_id', 'posts.posts','posts.created_at as created_at','users.username','users.images')
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('posts.test', [
            'timelines' => $timelines
        ]);
    }



}
