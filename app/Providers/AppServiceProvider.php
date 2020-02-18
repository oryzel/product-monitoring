<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        //
        if(env('APP_ENV') !== 'local')
        {
            $url->forceSchema('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Interfaces\\ProductInterface", "App\Repositories\\ProductRepository");
        $this->app->bind("App\Interfaces\\ProductPhotoInterface", "App\Repositories\\ProductPhotoRepository");
        $this->app->bind("App\Interfaces\\ProductPriceHistoryInterface", "App\Repositories\\ProductPriceHistoryRepository");
    }
}
