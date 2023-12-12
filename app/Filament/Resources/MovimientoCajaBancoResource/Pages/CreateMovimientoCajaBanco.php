<?php

namespace App\Filament\Resources\MovimientoCajaBancoResource\Pages;

use App\Filament\Resources\MovimientoCajaBancoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovimientoCajaBanco extends CreateRecord
{
    protected static string $resource = MovimientoCajaBancoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
