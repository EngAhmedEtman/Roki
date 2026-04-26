<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Force HTTPS in production (handles reverse proxy / load balancer)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Dynamically set the root URL from the request so that
        // asset(), url(), Storage::url() all generate the correct domain
        // instead of the APP_URL value (which may still be localhost).
        if (request()->getHost() !== 'localhost') {
            $scheme = request()->isSecure() ? 'https' : 'http';
            URL::forceRootUrl($scheme . '://' . request()->getHost());
        }
    }
}
