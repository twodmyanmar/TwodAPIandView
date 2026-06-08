<?php

namespace App\Filament\Resources\EventDaysResource\Pages;

use App\Filament\Resources\EventDaysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventDays extends EditRecord
{
    protected static string $resource = EventDaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
