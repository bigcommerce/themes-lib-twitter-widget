<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\BigCommerce\BigCommerceOAuthorizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('BigCommerceOAuthorizer', function () {
            return new BigCommerceOAuthorizer();
        });
    }
}
