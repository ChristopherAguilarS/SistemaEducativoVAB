<?php

namespace App\Filament\Resources\ConceptoIngresoResource\Pages;

use App\Filament\Resources\ConceptoIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConceptoIngresos extends ListRecords
{
    protected static string $resource = ConceptoIngresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
