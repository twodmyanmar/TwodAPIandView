<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateHelper
{
    public static function getThisMonthObject()
    {
        $start = Carbon::now()->copy()->startOfMonth()->startOfDay();
        $end = Carbon::now()->copy()->startOfDay();

        $dateObjects = [];
        $cursor = $start->copy();
        while ($cursor->lte($end)) {
            $dateObjects[] = $cursor->copy();
            $cursor->addDay();
        }

        return $dateObjects;
    }

    public static function getLastTwoDay()
    {
        $lastTwoDay = Carbon::now()->subDay(2)->format("Y-m-d");
        return $lastTwoDay;
    }
}
