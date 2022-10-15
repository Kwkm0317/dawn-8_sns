<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Follow;
use App\Post;
use Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ここに追加
        view()->composer('*', function($view)
        {
            $view->with('user', Auth::user());
            $view->with('follow_count', Follow::where('follow_id', Auth::id())->count());
            $view->with('follower_count', Follow::where('follower_id', Auth::id())->count());
         });

    }
}
