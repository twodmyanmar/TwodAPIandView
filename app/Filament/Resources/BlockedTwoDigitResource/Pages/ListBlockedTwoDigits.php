<?php

namespace App\Filament\Resources\BlockedTwoDigitResource\Pages;

use App\Filament\Resources\BlockedTwoDigitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlockedTwoDigits extends ListRecords
{
    protected static string $resource = BlockedTwoDigitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
