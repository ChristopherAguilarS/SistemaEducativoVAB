<?php

namespace App\Filament\Resources\EspecificaNivel2Resource\Pages;

use App\Filament\Resources\EspecificaNivel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEspecificaNivel2s extends ListRecords
{
    protected static string $resource = EspecificaNivel2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
