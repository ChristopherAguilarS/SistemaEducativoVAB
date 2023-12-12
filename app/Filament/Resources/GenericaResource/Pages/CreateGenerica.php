<?php

namespace App\Filament\Resources\GenericaResource\Pages;

use App\Filament\Resources\GenericaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGenerica extends CreateRecord
{
    protected static string $resource = GenericaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
