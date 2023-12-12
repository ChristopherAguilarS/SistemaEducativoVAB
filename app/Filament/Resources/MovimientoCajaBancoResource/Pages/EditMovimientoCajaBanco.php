<?php

namespace App\Filament\Resources\MovimientoCajaBancoResource\Pages;

use App\Filament\Resources\MovimientoCajaBancoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMovimientoCajaBanco extends EditRecord
{
    protected static string $resource = MovimientoCajaBancoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
