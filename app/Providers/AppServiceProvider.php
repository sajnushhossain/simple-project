<?php

namespace App\Providers;

use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\HeaderComposer;
use App\Http\View\Composers\NavigationComposer;
use App\View\Components\CategorySubheader;
use App\View\Components\Header;
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
        Paginator::useBootstrapFour();

        Blade::component('header', Header::class);
        Blade::component('category-subheader', CategorySubheader::class);
        View::composer('components.navigation', NavigationComposer::class);
        View::composer('components.header', CategoryComposer::class);
        View::composer('components.header', HeaderComposer::class);
        View::composer('components.layout', CategoryComposer::class);
    }
}
