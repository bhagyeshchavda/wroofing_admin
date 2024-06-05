<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use App\Libraries\Constant;
use Request;
use App\Models\User;

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
        //
        view()->composer('common.sidebar', function ($view) {
            $menus = array();
            Schema::defaultStringLength(191);
            $userMenuList = Constant::getMenuList();
            $view->with('usermenu', $userMenuList)->with('menus', $userMenuList);
        });
    }
}
