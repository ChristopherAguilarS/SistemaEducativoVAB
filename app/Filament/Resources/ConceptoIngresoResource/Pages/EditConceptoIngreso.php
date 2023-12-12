<?php

namespace App\Filament\Resources\ConceptoIngresoResource\Pages;

use App\Filament\Resources\ConceptoIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConceptoIngreso extends EditRecord
{
    protected static string $resource = ConceptoIngresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
