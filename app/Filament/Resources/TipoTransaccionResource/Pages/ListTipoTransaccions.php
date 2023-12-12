<?php

namespace App\Filament\Resources\TipoTransaccionResource\Pages;

use App\Filament\Resources\TipoTransaccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoTransaccions extends ListRecords
{
    protected static string $resource = TipoTransaccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
