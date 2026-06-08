<?php

$base = rtrim((string) env('TWOD_PUBLIC_URL', 'https://twodtm.com'), '/');

return [
    /*
    |--------------------------------------------------------------------------
    | Public site / API base (frontend fetches this host’s /api/*)
    |--------------------------------------------------------------------------
    | Local: set TWOD_PUBLIC_URL= in .env to use same-origin url('/api/...').
    */
    'public_url' => $base,

    'endpoints' => [
        'live' => env('TWOD_API_LIVE', $base.'/api/live'),
        'live_yesterday' => env('TWOD_API_LIVE_YESTERDAY', $base.'/api/live/yesterday'),
        'hints_yesterday' => env('TWOD_API_HINTS_YESTERDAY', $base.'/api/hints/yesterday'),
        'event_days' => env('TWOD_API_EVENT_DAYS', $base.'/api/event-days'),
        'calendar' => env('TWOD_API_CALENDAR', $base.'/api/calendar'),
        'trading_closures' => env('TWOD_API_TRADING_CLOSURES', $base.'/api/trading-closures'),
    ],
];
