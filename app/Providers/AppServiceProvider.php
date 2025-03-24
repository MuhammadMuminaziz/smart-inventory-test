<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Routing\UrlGenerator;
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
    public function boot(UrlGenerator $url): void
    {
        if(env('APP_ENV') !== 'local')
        {
            $url->forceSchema('https');
        }
        // Filament::registerRenderHook('head.start', function () {
        //     return '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">';
        // });
    }
}
