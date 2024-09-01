<?php

namespace App\Http\Controllers;

use App\Models\Results;
use App\Services\FourDigitCrawlerService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\TwoDigitCrawlerService;
use App\Services\ThreeDigitCrawlerService;
use App\Traits\ApiResponser;
use App\Traits\DateHelper;




class ApiController extends Controller
{
    use ApiResponser,DateHelper;

    protected $twoDigitCrawlerService;
    protected $threeDigitCrawlerService;
    protected $fourDigitCrawlerService;

    public function __construct(TwoDigitCrawlerService $twoDigitCrawlerService, ThreeDigitCrawlerService $threeDigitCrawlerService, FourDigitCrawlerService $fourDigitCrawlerService)
    {
        $this->twoDigitCrawlerService = $twoDigitCrawlerService;
        $this->threeDigitCrawlerService = $threeDigitCrawlerService;
        $this->fourDigitCrawlerService = $fourDigitCrawlerService;

    }

    public function live()
    {
        $data = $this->twoDigitCrawlerService->live();
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'set' => 'required|string',
            'value' => 'required|string',
            'status' => 'required|string',
            'recorded_at' => 'required|date',
            'open_time' => 'required|string',
        ]);

        $result = Results::create($data);

        return response()->json($result, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'set' => 'required|string',
            'value' => 'required|string',
            'status' => 'required|string',
            'recorded_at' => 'required|date',
            'open_time' => 'required|string',
        ]);

        $result = Results::findOrFail($id);
        $result->update($data);

        return response()->json($result);
    }

    public function autoUpdate()
    {
        $this->crawlerService->__construct();
        return response()->json(['message' => 'Data auto-updated successfully']);
    }

    public function threedlive()
    {
        $data = $this->threeDigitCrawlerService->live();
        return response()->json($data);

    }

    public function fourdlive()
    {
        $data = $this->fourDigitCrawlerService->live();
        return response()->json($data);
    }


    public function watch(Request $request)
    {
        date_default_timezone_set('Asia/Yangon');
        $today = now()->toDateString();
        $timeStrings = [
            [
                "10:41:00", "10:42:00", "10:43:00", "10:44:00", "10:45:00",
                "10:46:00", "10:47:00", "10:48:00", "10:49:00", "10:50:00",
                "10:51:00", "10:52:00", "10:53:00", "10:54:00", "10:55:00",
                "10:56:00", "10:57:00", "10:58:00", "10:59:00", "11:00:00",
            ],
            [
                "04:19:00", "04:20:00", "04:21:00", "04:22:00", "04:23:00",
                "04:24:00", "04:25:00", "04:26:00", "04:27:00", "04:28:00",
                "04:29:00", "04:30:00", "04:31:00", "04:32:00", "04:33:00",
                "04:34:00", "04:35:00", "04:36:00", "04:37:00", "04:38:00"
            ],
        ];

        $timeString = $timeStrings[1]; // Set a default value for $timeString

        if ($request->index != null) {
            $index = intval($request->index);
            $timeString = $timeStrings[$index];
        }

        $eventGroup = [];
        foreach ($timeString as $time) {
            $events = [];
            foreach ($timeString as $times) {
                $event = Results::where('open_time', $times)
                                ->where('recorded_at', $today)
                                ->first();
                $events[] = [
                    "time" => $times,
                    "set" => $event ? $event->set : null,
                    "value" => $event ? $event->value : null,
                    "number" => $event ? $event->number : null,
                ];
            }
            $eventGroup[$time] = $events;
        }

        return response()->json([
            "events" => $eventGroup
        ]);
    }



    public function yesterdayLive()
    {
    // Set the timezone to 'Asia/Yangon'
    date_default_timezone_set('Asia/Yangon');

    // Get yesterday's date and format it as 'Y-m-d'
    $yesterday = Carbon::yesterday()->format('Y-m-d');

    // Query the database to retrieve events recorded yesterday
    $yesterdayEvents = Results::whereDate('recorded_at', $yesterday)->get();

    // Initialize an empty array to store yesterday's events at specific times
    $specificTimeEvents = [];

    // Define the specific times of interest
    $specificTimes = ['12:00', '12:01', '16:20', '16:30'];

    // Iterate over the events retrieved
    foreach ($yesterdayEvents as $event) {
        // Extract the time from the recorded_at field
        $eventTime = Carbon::parse($event->recorded_at)->format('H:i');

        // Check if the event occurred at specific times
        if (in_array($eventTime, $specificTimes)) {
            // Format the recorded_at field without milliseconds and microseconds
            $event->recorded_at = Carbon::parse($event->recorded_at)->format('Y-m-d H:i:s');
            // If the event matches the specified times, add it to the array
            $specificTimeEvents[] = $event;
        }
    }

    // Return a JSON response with the status, message, and data
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully retrieved!',
        'data' => $specificTimeEvents,
    ]);
}



    public function getLastTwoDay()
    {
        return Carbon::now()->subDays(2)->format('Y-m-d');
    }

    public function lastTwoDayLive()
    {
        date_default_timezone_set('Asia/Yangon');
        $lastTwoDay = $this->getLastTwoDay();

        $editData = Results::whereDate('open_time', $lastTwoDay)
                        ->whereIn('open_time', ['12:00', '12:01', '16:00', '16:30'])
                        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved!',
            'data' => $editData
        ]);
    }


    // public function calendar()
    // {
    //     date_default_timezone_set('Asia/Yangon');
    //     $today = now()->toDateString();
    //     $firstDayOfMonth = Carbon::now()->startOfMonth();
    //     $calendarData = Results::whereBetween('recorded_at', [$firstDayOfMonth,$today])
    //                                     ->where('open_time', ['12:00','16:30'])
    //                                     ->orWhere('open_time', ['16:30','12:00'])
    //                                     ->get()
    //                                     ->groupBy('recorded_at');




    //     $dateObjects =  $this->getThisMonthObject();
    //     $oneMonthData = [];
    //     // dd($dateObjects);
    //     foreach ($dateObjects as $date) {
    //         $formattedDate = $date->format('Y-m-d');
    //         $oneMonthData[$formattedDate] = isset($calendarData[$formattedDate]) ? $calendarData[$formattedDate] : [];
    //     }


    //     return $this->successResponse($oneMonthData, 'one month data');
    // }


    public function calendar()
    {
        date_default_timezone_set('Asia/Yangon');
        $today = now()->toDateString();
        $firstDayOfMonth = Carbon::now()->startOfMonth();

        // Fetching the records with the specific open_time values and between the dates
        $calendarData = Results::whereBetween('recorded_at', [$firstDayOfMonth, $today])
                            ->whereIn('open_time', ['12:00', '16:30'])
                            ->get()
                            ->groupBy(function($date) {
                                return Carbon::parse($date->recorded_at)->format('Y-m-d');
                            });

        $dateObjects =  $this->getThisMonthObject();
        $oneMonthData = [];

        foreach ($dateObjects as $date) {
            $formattedDate = $date->format('Y-m-d');
            $oneMonthData[$formattedDate] = isset($calendarData[$formattedDate]) ? $calendarData[$formattedDate] : [];
        }

        return $this->successResponse($oneMonthData, 'one month data');
    }





}
