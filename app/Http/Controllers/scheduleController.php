<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EventDays;
use App\Models\Results;
use Illuminate\Support\Carbon;
use App\Services\TwoDigitCrawlerService;
use App\Services\ThreeDigitCrawlerService;
use App\Services\FourDigitCrawlerService;
use App\Traits\ApiResponser;
use App\Traits\DateHelper;

class scheduleController extends Controller
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

    public function getEventDays()
    {
        $eventDays = EventDays::all(['event_date', 'title']);
        return response()->json($eventDays);
    }





    private function getEventColor($date)
    {
        $carbonDate = Carbon::parse($date);
        if ($carbonDate->isWeekend()) {
            return 'red'; // Closed days color
        }
        return null; // Default color for open days
    }

    // Helper function to determine event icon (closed or marked days)
    private function getEventIcon($date)
    {
        $carbonDate = Carbon::parse($date);
        if ($carbonDate->isWeekend()) {
            return 'closed-icon'; // Icon for closed days
        }
        return null; // No icon for open days
    }

    public function index()
    {
        $eventDays = EventDays::all();
        return view('event_days.index', compact('eventDays'));
    }

    public function create()
    {
        return view('event_days.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date|unique:event_days,event_date',
        ]);

        EventDays::create($request->all());

        return redirect()->route('event_days.index')->with('success', 'Event day created successfully.');
    }

    public function edit(EventDays $eventDay)
    {
        return view('event_days.edit', compact('eventDay'));
    }

    public function update(Request $request, EventDays $eventDay)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date|unique:event_days,event_date,' . $eventDay->id,
        ]);

        $eventDay->update($request->all());

        return redirect()->route('event_days.index')->with('success', 'Event day updated successfully.');
    }

    public function destroy(EventDays $eventDay)
    {
        $eventDay->delete();

        return redirect()->route('event_days.index')->with('success', 'Event day deleted successfully.');
    }
}
