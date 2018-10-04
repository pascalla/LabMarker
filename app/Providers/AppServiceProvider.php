<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Lab;
use App\Observers\LabObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Lab::observe(LabObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
