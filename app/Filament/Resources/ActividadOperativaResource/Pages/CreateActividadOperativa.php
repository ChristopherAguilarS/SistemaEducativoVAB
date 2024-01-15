<?php

namespace App\Filament\Resources\ActividadOperativaResource\Pages;

use App\Filament\Resources\ActividadOperativaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateActividadOperativa extends CreateRecord
{
    protected static string $resource = ActividadOperativaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
