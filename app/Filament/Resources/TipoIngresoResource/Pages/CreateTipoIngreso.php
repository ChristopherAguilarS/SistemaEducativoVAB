<?php

namespace App\Filament\Resources\TipoIngresoResource\Pages;

use App\Filament\Resources\TipoIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoIngreso extends CreateRecord
{
    protected static string $resource = TipoIngresoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
