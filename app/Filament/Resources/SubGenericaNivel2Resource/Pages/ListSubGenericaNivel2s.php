<?php

namespace App\Filament\Resources\SubGenericaNivel2Resource\Pages;

use App\Filament\Resources\SubGenericaNivel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubGenericaNivel2s extends ListRecords
{
    protected static string $resource = SubGenericaNivel2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
