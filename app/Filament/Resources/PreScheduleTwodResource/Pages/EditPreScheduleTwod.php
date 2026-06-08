<?php

namespace App\Filament\Resources\PreScheduleTwodResource\Pages;

use App\Filament\Resources\PreScheduleTwodResource;
use App\Models\BlockedTwoDigit;
use App\Models\PreScheduleTwod;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditPreScheduleTwod extends EditRecord
{
    protected static string $resource = PreScheduleTwodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['number'] = BlockedTwoDigit::normalizeNumber((string) ($data['number'] ?? ''));

        if (BlockedTwoDigit::isBlocked($data['number'])) {
            throw ValidationException::withMessages([
                'number' => 'ဤကဏန်းသည် မရကဏန်းစာရင်းတွင် ပါသဖြင့် ပြင်မရပါ။',
            ]);
        }

        $duplicate = PreScheduleTwod::query()
            ->whereDate('schedule_date', $data['schedule_date'])
            ->where('open_time', $data['open_time'])
            ->where('id', '!=', $this->record->id)
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'open_time' => 'ဤနေ့ဤအချိန်တွင် စာရင်းရှိပြီးသား ဖြစ်ပါသည်။',
            ]);
        }

        $data['set'] = ($data['set'] ?? '') !== '' ? $data['set'] : '--';
        $data['value'] = ($data['value'] ?? '') !== '' ? $data['value'] : '--';

        return $data;
    }
}
