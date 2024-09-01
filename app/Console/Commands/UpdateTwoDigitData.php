<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TwoDigitCrawlerService;

class UpdateTwoDigitData extends Command
{
    protected $signature = 'update:twodigitdata';
    protected $description = 'Update Two Digit Data';

    protected $crawlerService;

    public function __construct(TwoDigitCrawlerService $crawlerService)
    {
        parent::__construct();
        $this->crawlerService = $crawlerService;
    }

    public function handle()
    {
        $this->crawlerService->__construct();
        $this->info('Two Digit Data Updated');
    }
}
