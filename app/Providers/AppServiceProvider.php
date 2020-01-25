<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/* Fix Laravel issue on string length. This affects Laravels migration to MySQL and MariaDB */
use Illuminate\Support\Facades\Schema;

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
        /* Fix Laravel issue on string length. This affects Laravels migration to MySQL and MariaDB */
        Schema::defaultStringLength(191);
    }
}
