<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // 全ユーザー情報の取得
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(10);
    }
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'follow_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_id', 'follower_id');
    }
    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }
    // フォロー解除する
    public function unFollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('follower_id', $user_id)->first(['follow_id']);
    }

    // フォローされているか
    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('follow_id', $user_id)->first(['follower_id']);
    }

}
