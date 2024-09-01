<?php

namespace App\Console;

use App\Services\TwoDigitCrawlerService;
use App\Services\FourDigitCrawlerService;
use App\Services\ThreeDigitCrawlerService;
use App\Console\Commands\UpdateTwoDigitData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            app(TwoDigitCrawlerService::class);
        })->cron('0,1 12 * * *')->timezone('Asia/Yangon');

        $schedule->call(function () {
            app(ThreeDigitCrawlerService::class);
        })->cron('5 15 * * *')->timezone('Asia/Yangon');

        $schedule->call(function () {
            app(TwoDigitCrawlerService::class);
        })->cron('20 16 * * *')->timezone('Asia/Yangon');

        $schedule->call(function () {
            app(FourDigitCrawlerService::class);
        })->cron('5 16 * * *')->timezone('Asia/Yangon');

        $schedule->call(function () {
            app(TwoDigitCrawlerService::class);
        })->cron('30 16 * * *')->timezone('Asia/Yangon');

        $schedule->command('update:twodigitdata')->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
