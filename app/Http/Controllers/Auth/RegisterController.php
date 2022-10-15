<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB, Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed', //confirmedを条件に入れておくと、同じ名前_confirmationのものと値が同じかどうかチェックしてくれる
            'password_confirmation' => 'required|string|min:4',
        ],
        [
            'username.required' => '必須項目です',
            'mail.required' => '必須項目です',
            'mail.email' => 'メールアドレスではありません',
            'mail.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => '必須項目です',
            'password.min' => '4文字以上で入力してください',
            'password_confirmation.required' => '必須項目です',
            'password_confirmation.min' => '4文字以上で入力してください',
            'password.confirmed' => '入力したパスワードが一致していません',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) //arrayは型(配列)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);

        //return redirect('added');
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){ //Requestは指定したクラスのインスタンス（メソッドインジェクション：依存注入 によるもの）
        //Request:フォームに入力されたものを受け取るクラス
        if($request->isMethod('post')){ //getかpostかの判断。ここはpostで送信されてきたかどうか
            $data = $request->input(); //inputタグに入力されているものをinput()を使って取り出す。引数指定しない場合は全部取り出すことができる。

                $this->validator($data)->validate();
                $this->create($data);

                return redirect('added')->with('username', $data['username']);

        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}