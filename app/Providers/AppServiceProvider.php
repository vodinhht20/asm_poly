<?php

namespace App\Providers;

use App\Models\MainMajors;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();
        View::composer('layouts.header', function ($view) {
            $menus = MainMajors::all();
            $menus->load("navSubMajors");
            $view->with('menus', $menus);
        });
    }
}
