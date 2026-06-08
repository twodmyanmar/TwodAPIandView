<?php

namespace App\Http\Controllers;


use App\Models\Hint;
use App\Models\Results;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class WatchController extends Controller
{
    public function index(Request $request)
{
    date_default_timezone_set('Asia/Yangon');
    $today = now()->toDateString();

    // Generate time strings from 10:41:00 to 16:35:00
    $start = new \DateTime('10:41:00');
    $end = new \DateTime('16:35:00');
    $end->modify('+1 minute'); // Include the end time in the range
    $interval = new \DateInterval('PT1M'); // 1-minute interval
    $timePeriod = new \DatePeriod($start, $interval, $end);

    $timeStrings = [];
    foreach ($timePeriod as $time) {
        $timeStrings[] = $time->format('H:i:s');
    }

    // Set a default value for $timeString (all times)
    $timeString = $timeStrings;

    // If index is passed in request, use it to set $timeString
    if ($request->index !== null) {
        $index = intval($request->index);
        if (isset($timeStrings[$index])) {
            $timeString = [$timeStrings[$index]];
        }
    }

    $eventGroup = [];
    foreach ($timeString as $time) {
        // Debugging: Print the time and date being queried
        \Log::info("Querying for time: $time on date: $today");

        $event = Results::where('recorded_at', $time)
                        ->where('open_time', $today)
                        ->first();

        if ($event) {
            \Log::info("Found event: " . json_encode($event));
        } else {
            \Log::info("No event found for time: $time on date: $today");
        }

        $eventGroup[$time] = [
            "time" => $time,
            "set" => $event ? $event->set : 0,    // Default value set to 0
            "value" => $event ? $event->value : 0, // Default value set to 0
            "number" => $event ? $event->number : '', // Default value set to an empty string
        ];
    }

    return response()->json([
        "events" => $eventGroup
    ]);
}








    public function weekly()
    {
        $startWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        $weeklyRecords = Results::whereBetween('open_time', [$startWeek, $endWeek])->get();
        return $this->successResponse($weeklyRecords, 'Data retrieved successfully!');
    }

    // private function successResponse($data, $message = 'Operation successful', $status = 200)
    // {
    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message,
    //         'data' => $data,
    //     ], $status);
    // }

    public function weeklyResult()
    {
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();

        if ($startWeek->isSaturday()) {
            $startWeek->addDays(2)->format('Y-m-d');
        } elseif ($startWeek->isSunday()) {
            $startWeek->addDay()->format('Y-m-d');
        }

        if ($endWeek->isSunday()) {
            $endWeek->subDays(2)->format('Y-m-d');
        } elseif ($endWeek->isSaturday()) {
            $endWeek->subDay()->format('Y-m-d');
        }
        $weeklyRecords = Results::whereBetween('recorded_at', [$startWeek, $endWeek])
            ->where('recorded_at', ["16:00", "16:30", "12:01", "12:00"])
            ->orWhere('recorded_at', ["12:00", "12:01", "16:00", "16:30"])
            ->get()
            ->groupBy('results');
        $weeklyHints = Hint::whereBetween('date', [$startWeek, $endWeek])->get()->groupBy('date');
        $compareResults = [];
        foreach ($weeklyRecords as $key => $value) {
            if (isset($weeklyHints[$key])) {
                $compareResults[$key] = array_merge($value->toArray(), $weeklyHints[$key]->toArray());
            }
        }

        return $this->successResponse($compareResults, 'success!');
    }
}
