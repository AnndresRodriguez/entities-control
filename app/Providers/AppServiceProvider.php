<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(250);

        Carbon::setLocale(\config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Staudenmeir\DuskUpdater\DuskServiceProvider::class);
        }

    }

    
}
