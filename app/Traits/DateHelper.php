<?php

namespace App\Traits;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;

trait DateHelper
{
    public static function getThisMonthObject()
    {
        $firstDayOfMonth = now()->startOfMonth();
        $lastDayOfMonth = now();
        $datePeriod = new DatePeriod($firstDayOfMonth, new DateInterval('P1D'), $lastDayOfMonth);

        $dateObjects = [];
        foreach ($datePeriod as $date) {
            $carbonDate = Carbon::instance($date);
            if (!$carbonDate->isWeekend()) { // Check for weekdays directly
                $dateObjects[] = $date;
            }
        }
        return $dateObjects;
    }

    public static function getLastTwoDay()
    {
        $lastTwoDay = Carbon::now()->subDay(2)->format("Y-m-d");
        return $lastTwoDay;
    }
}
