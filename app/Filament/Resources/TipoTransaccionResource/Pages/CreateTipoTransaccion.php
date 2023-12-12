<?php

namespace App\Filament\Resources\TipoTransaccionResource\Pages;

use App\Filament\Resources\TipoTransaccionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoTransaccion extends CreateRecord
{
    protected static string $resource = TipoTransaccionResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data['tipo'] == null || $data['tipo'] != 0){
            $data['fecha_vigencia'] = null;
            $data['monto'] = null;
        }
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
