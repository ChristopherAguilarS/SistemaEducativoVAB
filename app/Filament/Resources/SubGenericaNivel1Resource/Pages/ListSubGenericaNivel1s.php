<?php

namespace App\Filament\Resources\SubGenericaNivel1Resource\Pages;

use App\Filament\Resources\SubGenericaNivel1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubGenericaNivel1s extends ListRecords
{
    protected static string $resource = SubGenericaNivel1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
