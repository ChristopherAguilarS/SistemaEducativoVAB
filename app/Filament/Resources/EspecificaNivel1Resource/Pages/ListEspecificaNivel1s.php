<?php

namespace App\Filament\Resources\EspecificaNivel1Resource\Pages;

use App\Filament\Resources\EspecificaNivel1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEspecificaNivel1s extends ListRecords
{
    protected static string $resource = EspecificaNivel1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
