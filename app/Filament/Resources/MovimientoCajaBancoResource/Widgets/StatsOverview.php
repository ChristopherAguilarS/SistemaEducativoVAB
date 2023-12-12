<?php

namespace App\Filament\Resources\MovimientoCajaBancoResource\Widgets;

use App\Filament\Resources\MovimientoCajaBancoResource\Pages\ListMovimientoCajaBancos;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageTable;
 
    protected function getTablePage(): string
    {
        return ListMovimientoCajaBancos::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('DEUDOR', 'S/. '.$this->getPageTableQuery()->where('tipo',1)->where('estado',1)->sum('monto'))
            ->color('success')
            ->description(' ')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->extraAttributes([
                'class' => 'bg-primary'
            ]),
            Stat::make('ACREEDOR', 'S/. ' .$this->getPageTableQuery()->where('tipo',2)->where('estado',1)->sum('monto'))
            ->description(' ')
            ->descriptionIcon('heroicon-m-arrow-trending-down')->color('danger'),
            Stat::make('SALDO', 'S/. ' .$this->getPageTableQuery()->where('tipo',1)->where('estado',1)->sum('monto') - $this->getPageTableQuery()->where('tipo',2)->where('estado',1)->sum('monto')),
        ];
    }
}
