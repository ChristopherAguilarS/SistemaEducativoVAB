<?php

namespace App\Filament\Resources\CuentaResource\Pages;

use App\Filament\Resources\CuentaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCuenta extends CreateRecord
{
    protected static string $resource = CuentaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
