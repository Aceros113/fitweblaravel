<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Login;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $loginId = Session::get('login_id');
            $login = Login::find($loginId);
    
            $user = $login && $login->loginable ? $login->loginable : null;
    
            $view->with('user', $user);
        });
    }
}
