<?php

namespace App\Filament\Resources\ConceptoIngresoResource\Pages;

use App\Filament\Resources\ConceptoIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConceptoIngreso extends CreateRecord
{
    protected static string $resource = ConceptoIngresoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
