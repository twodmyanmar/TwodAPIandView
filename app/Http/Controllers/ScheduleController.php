<?php

namespace App\Http\Controllers;

use App\Models\EventDays;
use App\Traits\ApiResponser;
use App\Traits\DateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{
    use ApiResponser;
    use DateHelper;

    public function getEventDays()
    {
        $eventDays = EventDays::all(['event_date', 'title']);

        return response()->json($eventDays);
    }

    /**
     * Weekends + saved SET-style closure days (admin event_days) for calendar overlay.
     */
    public function tradingClosures(Request $request)
    {
        date_default_timezone_set('Asia/Yangon');
        $year = (int) $request->input('year', now()->year);
        $month = (int) $request->input('month', now()->month);

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();
        $today = now()->startOfDay();
        if ($end->gt($today)) {
            $end = $today;
        }

        $events = [];
        $cursor = $start->clone();
        $custom = EventDays::query()
            ->whereBetween('event_date', [$start->toDateString(), $end->toDateString()])
            ->pluck('title', 'event_date');

        while ($cursor->lte($end)) {
            $d = $cursor->format('Y-m-d');
            if ($cursor->isWeekend()) {
                $events[] = [
                    'date' => $d,
                    'title' => 'စနေ/တန္မြနေ (SET ပိတ်)',
                    'type' => 'weekend',
                ];
            } elseif ($custom->has($d)) {
                $events[] = [
                    'date' => $d,
                    'title' => $custom[$d],
                    'type' => 'holiday',
                ];
            }
            $cursor->addDay();
        }

        return response()->json($events);
    }
}
