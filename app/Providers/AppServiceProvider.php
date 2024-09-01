<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TwoDigitCrawlerService;
use App\Services\FourDigitCrawlerService;
use App\Services\ThreeDigitCrawlerService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TwoDigitCrawlerService::class, function ($app) {
            return new TwoDigitCrawlerService();
        });

        $this->app->singleton(ThreeDigitCrawlerService::class, function ($app) {
            return new ThreeDigitCrawlerService();
        });

        $this->app->singleton(FourDigitCrawlerService::class, function ($app) {
            return new FourDigitCrawlerService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
