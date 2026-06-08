<?php

namespace App\Filament\Resources\PreScheduleTwodResource\Pages;

use App\Filament\Resources\PreScheduleTwodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreScheduleTwods extends ListRecords
{
    protected static string $resource = PreScheduleTwodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
