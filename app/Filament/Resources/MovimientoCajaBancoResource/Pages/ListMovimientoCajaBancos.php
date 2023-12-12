<?php

namespace App\Filament\Resources\MovimientoCajaBancoResource\Pages;

use App\Filament\Resources\MovimientoCajaBancoResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;


class ListMovimientoCajaBancos extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = MovimientoCajaBancoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MovimientoCajaBancoResource\Widgets\StatsOverview::class
        ];
    }
}
