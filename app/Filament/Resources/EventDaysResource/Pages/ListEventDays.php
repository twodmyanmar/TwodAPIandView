<?php

namespace App\Filament\Resources\EventDaysResource\Pages;

use App\Filament\Resources\EventDaysResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventDays extends ListRecords
{
    protected static string $resource = EventDaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
