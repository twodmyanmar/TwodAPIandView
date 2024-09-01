<?php

namespace App\Http\Controllers;

use App\Models\Hint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HintController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Yangon');
        $date = date('Y-m-d');
        $hints = Hint::where('date',$date)->get();
        return response()->json([
            'hints' => $hints
        ]);
    }

    public function yesterdayHints()
    {
        date_default_timezone_set('Asia/Yangon');
        $yesterday = Carbon::yesterday()->format("Y-m-d");
        $nowEvents = Hint::where('date', $yesterday)->get();
        $yesterdayEvents = [];
        foreach($nowEvents as $event)
        {
            if($event->time == "09:30:00")
            {
                $yesterdayEvents[] = $event;
            }
            elseif ($event->time == "14:00:00") {
                $yesterdayEvents[] = $event;
            } else {

            }
        }

        return response()->json([
            'hints' => $yesterdayEvents
        ]);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Yangon');
        $hint = Hint::find($request->id);
        $hint->money = $request->money;
        $hint->morden = $request->morden;
        $hint->internet = $request->internet;
        $hint->save();
        if($hint)
        {
            return response()->json([
                "hint" => $hint,
                "status" => true,
            ]);
        }
        return response()->json([
            "hint" => null,
            "status" => false,
        ]);
    }
}
