<?php

namespace App\Providers;

use App\Entities\UserPayback;
use App\Observers\UserPaybackObserver;
use Illuminate\Support\ServiceProvider;

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
        UserPayback::observe(UserPaybackObserver::class);
    }
}
