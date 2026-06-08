<?php

namespace App\Filament\Resources\PreScheduleTwodResource\Pages;

use App\Filament\Resources\PreScheduleTwodResource;
use App\Models\BlockedTwoDigit;
use App\Models\PreScheduleTwod;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreatePreScheduleTwod extends CreateRecord
{
    protected static string $resource = PreScheduleTwodResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['number'] = BlockedTwoDigit::normalizeNumber((string) ($data['number'] ?? ''));

        if (BlockedTwoDigit::isBlocked($data['number'])) {
            throw ValidationException::withMessages([
                'number' => 'ဤကဏန်းသည် မရကဏန်းစာရင်းတွင် ပါသဖြင့် ကြိုတင်တင်မရပါ။',
            ]);
        }

        if (PreScheduleTwod::query()
            ->whereDate('schedule_date', $data['schedule_date'])
            ->where('open_time', $data['open_time'])
            ->exists()) {
            throw ValidationException::withMessages([
                'open_time' => 'ဤနေ့ဤအချိန်တွင် စာရင်းရှိပြီးသား ဖြစ်ပါသည်။',
            ]);
        }

        $data['set'] = ($data['set'] ?? '') !== '' ? $data['set'] : '--';
        $data['value'] = ($data['value'] ?? '') !== '' ? $data['value'] : '--';
        $data['status'] = $data['status'] ?? '1';

        return $data;
    }
}
