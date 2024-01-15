<?php

namespace App\Filament\Resources\ActividadOperativaResource\Pages;

use App\Filament\Resources\ActividadOperativaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActividadOperativas extends ListRecords
{
    protected static string $resource = ActividadOperativaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
