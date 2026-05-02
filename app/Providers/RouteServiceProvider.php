<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Redirect setelah login
     */
    public const HOME = '/admin/dashboard';

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}