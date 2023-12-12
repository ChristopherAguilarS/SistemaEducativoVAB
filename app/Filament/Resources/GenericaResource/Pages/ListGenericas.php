<?php

namespace App\Filament\Resources\GenericaResource\Pages;

use App\Filament\Resources\GenericaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGenericas extends ListRecords
{
    protected static string $resource = GenericaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
