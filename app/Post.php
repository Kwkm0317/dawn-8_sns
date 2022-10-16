<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //投稿に関する操作
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    // public function postStore(Int $user_id, Array $data){
    //     $this->user_id = $user_id;
    //     $this->posts = $data['text'];
    //     $this->save();
    // }
}
