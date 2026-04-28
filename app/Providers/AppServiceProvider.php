<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
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
        // ✅ FIX PAGINATION (Bootstrap 4)
        Paginator::useBootstrapFour();

        // ✅ NAVBAR CATEGORIES (GLOBAL)
        View::composer('customer.partial.navonly', function ($view) {

            $navCategories = Category::has('products')
                ->withCount('products')
                ->orderBy('products_count', 'desc')
                ->get();

            $view->with('navCategories', $navCategories);
        });
    }
}