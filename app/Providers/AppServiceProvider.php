<?php

namespace App\Providers;

use App\Models\Campus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('auth.register', function ($view) {
            $campuses = Campus::all();
            $view->with('campuses', $campuses);
        });
    }
}
