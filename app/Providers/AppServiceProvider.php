<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
    View::composer('customer.partial.navonly', function ($view) {

        $navCategories = Category::has('products')
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();

        $view->with('navCategories', $navCategories);
    });
}
}
