<?php

namespace App\Services;

use App\Models\EventDays;
use App\Models\PreScheduleTwod;
use App\Models\Results;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TwoDigitCrawlerService
{
    protected $set;

    protected $value;

    protected $status;

    protected $openTime;

    protected $openTimes = ['12:00', '12:01', '16:20', '16:30'];

    protected $timezone = 'Asia/Yangon';

    protected bool $booted = false;

    protected function bootFromMarket(): void
    {
        if ($this->booted) {
            return;
        }

        try {
            [$this->set, $this->value, $this->status] = $this->getValuesFromSite();
            $this->openTime = $this->getOpenTime();

            if ($this->openTime !== 'Time not available') {
                $this->saveResult();
            }
        } catch (\Throwable) {
            $this->set = '--';
            $this->value = '--';
            $this->status = '0';
            $this->openTime = 'Time not available';
        }

        $this->booted = true;
    }

    public function getSet(): string
    {
        $this->bootFromMarket();

        return $this->set;
    }

    public function getVal(): string
    {
        $this->bootFromMarket();

        return $this->value;
    }

    public function getNumber(): string
    {
        $this->bootFromMarket();

        if ($this->set === '--' || $this->value === '--' || ! str_contains((string) $this->value, '.')) {
            return '--';
        }

        $number = '';
        $number .= substr((string) $this->set, -1);
        $number .= substr(strstr((string) $this->value, '.', true), -1);

        return $number;
    }

    public function getStatus(): string
    {
        $this->bootFromMarket();

        return (string) $this->status;
    }

    public function getOpenTime()
    {
        foreach ($this->openTimes as $time) {
            if ($this->isWithinTimeFrame($time)) {
                return $time;
            }
        }

        return 'Time not available';
    }

    private function getValuesFromSite(): array
    {
        $response = Http::get('https://www.set.or.th/th/market/product/stock/overview');
        $dom = new \Symfony\Component\DomCrawler\Crawler($response->body());

        return $this->filterValues($dom);
    }

    private function filterValues($dom): array
    {
        $cols = $dom->filter('div.table-index-overview')
            ->filter('table')
            ->eq(1)
            ->filter('tr')
            ->eq(1)
            ->filter('td');
        $set = $cols->eq(1)->text();
        $val = $cols->eq(7)->text();
        $status = $dom->filter('div > small.text-end')->text();
        $status = trim(substr($status, strpos($status, ':') + 1));

        return [$set, $val, $status];
    }

    private function isWithinTimeFrame($time)
    {
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));

        return $currentTime->format('H:i') === $time;
    }

    private function saveResult()
    {
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));

        Results::create([
            'set' => $this->set,
            'value' => $this->value,
            'number' => $this->getNumber(),
            'status' => $this->status,
            'recorded_at' => $currentTime,
            'open_time' => $this->openTime,
        ]);
    }

    public function getLiveData(): array
    {
        $this->bootFromMarket();
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));

        return [
            'set' => $this->set,
            'value' => $this->value,
            'time' => $currentTime->format('Y-m-d H:i:s'),
            'twod' => $this->getNumber(),
            'date' => $currentTime->format('Y-m-d'),
        ];
    }

    protected function slotHasPassed(string $openTime, Carbon $now): bool
    {
        $today = $now->format('Y-m-d');
        $slotEnd = Carbon::parse("{$today} {$openTime}", $this->timezone);

        return $now->greaterThanOrEqualTo($slotEnd);
    }

    protected function emptySlot(array $liveData, string $openTime, string $currentDate, DateTime $nowDt): array
    {
        $currentDateTime = new DateTime('now', new DateTimeZone($this->timezone));

        return [
            'set' => '--',
            'value' => '--',
            'open_time' => $openTime,
            'twod' => '--',
            'stock_date' => $currentDate,
            'stock_datetime' => $currentDateTime->format('Y-m-d H:i:s'),
            'history_id' => null,
            'status' => '1',
        ];
    }

    protected function liveFallbackSlot(array $liveData, string $openTime, string $currentDate): array
    {
        $currentDateTime = new DateTime('now', new DateTimeZone($this->timezone));

        return [
            'set' => $liveData['set'] ?? '--',
            'value' => $liveData['value'] ?? '--',
            'open_time' => $openTime,
            'twod' => $liveData['twod'] ?? '--',
            'stock_date' => $currentDate,
            'stock_datetime' => $currentDateTime->format('Y-m-d H:i:s'),
            'history_id' => null,
            'status' => $this->status,
        ];
    }

    public function getResultData(): array
    {
        $this->bootFromMarket();
        $results = [];
        $now = Carbon::now($this->timezone);
        $currentDate = $now->format('Y-m-d');
        $liveData = $this->getLiveData();

        foreach ($this->openTimes as $time) {
            $pre = PreScheduleTwod::query()
                ->whereDate('schedule_date', $currentDate)
                ->where('open_time', $time)
                ->first();

            if ($pre && ! $this->slotHasPassed($time, $now)) {
                $row = $this->emptySlot($liveData, $time, $currentDate, $now->toDateTime());
                $row['source'] = 'pre_pending';
                $results[] = $row;

                continue;
            }

            if ($pre && $this->slotHasPassed($time, $now)) {
                $slotTime = Carbon::parse("{$currentDate} {$time}", $this->timezone);
                $results[] = [
                    'set' => $pre->set,
                    'value' => $pre->value,
                    'open_time' => $time,
                    'twod' => $pre->number,
                    'stock_date' => $currentDate,
                    'stock_datetime' => $slotTime->format('Y-m-d H:i:s'),
                    'history_id' => null,
                    'status' => $pre->status,
                    'source' => 'pre',
                ];

                continue;
            }

            $record = Results::where('open_time', $time)
                ->whereDate('recorded_at', $currentDate)
                ->first();

            if ($record) {
                $recordedDateTime = new DateTime($record->recorded_at, new DateTimeZone($this->timezone));
                $results[] = [
                    'set' => $record->set,
                    'value' => $record->value,
                    'open_time' => $record->open_time,
                    'twod' => $record->number,
                    'stock_date' => $recordedDateTime->format('Y-m-d'),
                    'stock_datetime' => $recordedDateTime->format('Y-m-d H:i:s'),
                    'history_id' => $record->id,
                    'status' => $record->status,
                    'source' => 'db',
                ];

                continue;
            }

            if ($this->slotHasPassed($time, $now) && ! $pre) {
                $results[] = $this->liveFallbackSlot($liveData, $time, $currentDate);
                $results[count($results) - 1]['source'] = 'live';

                continue;
            }

            $results[] = $this->emptySlot($liveData, $time, $currentDate, $now->toDateTime());
            $results[count($results) - 1]['source'] = 'none';
        }

        return $results;
    }

    protected function holidayPayload(DateTime $currentTime): array
    {
        $carbon = Carbon::instance($currentTime)->setTimezone($this->timezone);
        $date = $carbon->format('Y-m-d');

        if ($carbon->isWeekend()) {
            return [
                'status' => '1',
                'date' => $date,
                'name' => 'စနေ/တနင်္ဂနွေ  ပိတ်သည်',
            ];
        }

        $ev = EventDays::whereDate('event_date', $date)->first();
        if ($ev) {
            return [
                'status' => '1',
                'date' => $date,
                'name' => $ev->title,
            ];
        }

        return [
            'status' => '0',
            'date' => $date,
            'name' => '',
        ];
    }

    public function live(): array
    {
        $this->bootFromMarket();
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));
        $liveData = $this->getLiveData();
        $resultData = $this->getResultData();

        return [
            'server_time' => $currentTime->format('Y-m-d H:i:s'),
            'live' => $liveData,
            'result' => $resultData,
            'holiday' => $this->holidayPayload($currentTime),
        ];
    }
}
