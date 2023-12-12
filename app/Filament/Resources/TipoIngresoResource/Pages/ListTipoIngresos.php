<?php

namespace App\Filament\Resources\TipoIngresoResource\Pages;

use App\Filament\Resources\TipoIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoIngresos extends ListRecords
{
    protected static string $resource = TipoIngresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
