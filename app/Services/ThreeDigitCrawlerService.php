<?php

namespace App\Services;

use DateTime;
use DateTimeZone;
use App\Models\Results;
use App\Models\ThreeResults;
use Illuminate\Support\Facades\Http;

class ThreeDigitCrawlerService
{
    protected $set;
    protected $value;
    protected $status;
    protected $openTime;
    protected $resultType;

    protected $openTimes = [
        '15:05' => 'threed',
        '16:05' => 'fourd'
    ];
    protected $timezone = 'Asia/Yangon';

    public function __construct()
    {
        [$this->set, $this->value, $this->status] = $this->getValuesFromSite();
        $this->openTime = $this->getOpenTime();

        // Automatically save if within open time
        if ($this->openTime !== 'Time not available') {
            $this->saveResult();
        }
    }

    public function getSet(): string
    {
        return $this->set;
    }

    public function getVal(): string
    {
        return $this->value;
    }

    public function getNumber(): string
    {
        $number = '';
        if ($this->resultType === 'threed') {
            $number .= substr($this->set, -1);
            $number .= substr(strstr($this->value, '.', true), -2);
        } elseif ($this->resultType === 'fourd') {
            // Logic for fourd result type
            $number .= substr($this->set, -2);
            $number .= substr(strstr($this->value, '.', true), -2);
        }

        return $number;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getOpenTime()
    {
        foreach ($this->openTimes as $time => $type) {
            if ($this->isWithinTimeFrame($time)) {
                $this->resultType = $type;
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
        $currentFormattedTime = $currentTime->format('H:i');

        ThreeResults::create([
            'set' => $this->set,
            'value' => $this->value,
            'number' => $this->getNumber(),
            'status' => $this->status,
            'recorded_at' => $currentTime,
            'open_time' => $this->openTime,
            'result_type' => $this->resultType,
        ]);
    }

    public function getLiveData(): array
    {
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));
        return [
            'set' => $this->set,
            'value' => $this->value,
            'time' => $currentTime->format('Y-m-d H:i:s'),
            'number' => $this->getNumber(),
            'date' => $currentTime->format('Y-m-d'),
            'result_type' => $this->resultType,
        ];
    }

    public function getResultData(): array
    {
        $results = [];
        $currentDate = (new DateTime('now', new DateTimeZone($this->timezone)))->format('Y-m-d');

        foreach ($this->openTimes as $time => $type) {
            $record = ThreeResults::where('open_time', $time)
                ->whereDate('recorded_at', $currentDate)
                ->where('result_type', $type)
                ->first();

            if ($record) {
                $recordedDateTime = new DateTime($record->recorded_at, new DateTimeZone($this->timezone));
                $results[] = [
                    'set' => $record->set,
                    'value' => $record->value,
                    'open_time' => $record->open_time,
                    'number' => $record->number,
                    'stock_date' => $recordedDateTime->format('Y-m-d'),
                    'stock_datetime' => $recordedDateTime->format('Y-m-d H:i:s'),
                    'history_id' => $record->id,
                    'result_type' => $record->result_type,
                ];
            } else {
                $currentDateTime = new DateTime('now', new DateTimeZone($this->timezone));
                $results[] = [
                    'set' => '--',
                    'value' => '--',
                    'open_time' => $time,
                    'number' => '---',
                    'stock_date' => $currentDateTime->format('Y-m-d'),
                    'stock_datetime' => $currentDateTime->format('Y-m-d H:i:s'),
                    'history_id' => null,
                    'result_type' => $type,
                ];
            }
        }

        return $results;
    }

    public function live(): array
    {
        $currentTime = new DateTime('now', new DateTimeZone($this->timezone));
        $liveData = $this->getLiveData();
        $resultData = $this->getResultData();

        return [
            'server_time' => $currentTime->format('Y-m-d H:i:s'),
            'live' => $liveData,
            'result' => $resultData,
            'holiday' => [
                'status' => '1',
                'date' => $currentTime->format('Y-m-d'),
                'name' => 'NULL',
            ]
        ];
    }
}
