<?php

namespace App\Filament\Resources\BlockedTwoDigitResource\Pages;

use App\Filament\Resources\BlockedTwoDigitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlockedTwoDigit extends EditRecord
{
    protected static string $resource = BlockedTwoDigitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
