<?php

namespace App\Providers;

use App\View\Components\Header;
use App\Http\View\Composers\NavigationComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        Model::unguard();
        Paginator::useBootstrap();

        Blade::component('header', Header::class);
        View::composer('components.navigation', NavigationComposer::class);
    }
}