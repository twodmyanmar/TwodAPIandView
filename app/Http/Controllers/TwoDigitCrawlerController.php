<?php

namespace App\Http\Controllers;

use App\Models\Results;
use Illuminate\Http\Request;
use App\Services\TwoDigitCrawlerService;

class TwoDigitCrawlerController extends Controller
{
    protected $twoDigitCrawlerService;

    public function __construct(TwoDigitCrawlerService $twoDigitCrawlerService)
    {
        $this->twoDigitCrawlerService = $twoDigitCrawlerService;
    }

    public function index()
    {
        $liveData = [
            'set' => $this->twoDigitCrawlerService->getSet(),
            'value' => $this->twoDigitCrawlerService->getVal(),
            'number' => $this->twoDigitCrawlerService->getNumber(),
            'status' => $this->twoDigitCrawlerService->getStatus(),
            'open_time' => $this->twoDigitCrawlerService->getOpenTime(),
        ];

        $results = Results::all();

        return response()->json([
            'live' => $liveData,
            'results' => $results
        ]);
    }
}
