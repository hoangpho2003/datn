<?php

namespace App\Providers;

use App\Models\Brand;
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
        View::composer('layouts.app', function ($view) {
            $categories = Category::orderBy('name')->take(5)->get();
            $brands = Brand::orderBy('name')->take(5)->get();
            $view->with('menuCategories', $categories);
            $view->with('menuBrands', $brands);
        });
    }
}
