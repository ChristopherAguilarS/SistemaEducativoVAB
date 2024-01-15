<?php

namespace App\Filament\Resources\CentroCostoResource\Pages;

use App\Filament\Resources\CentroCostoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCentroCosto extends CreateRecord
{
    protected static string $resource = CentroCostoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
