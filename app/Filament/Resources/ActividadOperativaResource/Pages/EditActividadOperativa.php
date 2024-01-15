<?php

namespace App\Filament\Resources\ActividadOperativaResource\Pages;

use App\Filament\Resources\ActividadOperativaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActividadOperativa extends EditRecord
{
    protected static string $resource = ActividadOperativaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
