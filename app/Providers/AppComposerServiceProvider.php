<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $rememberToken = request()->input('remember_token');
            $carts = [];
            if(auth()->check()){
                $carts = \Cart::session(auth()->id())->getContent();
            }
            $view->with('rememberToken', $rememberToken)->with('carts',$carts);
        });
    }
}
