<?php

namespace App\Filament\Resources\IndicadorResource\Pages;

use App\Filament\Resources\IndicadorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndicador extends CreateRecord
{
    protected static string $resource = IndicadorResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
