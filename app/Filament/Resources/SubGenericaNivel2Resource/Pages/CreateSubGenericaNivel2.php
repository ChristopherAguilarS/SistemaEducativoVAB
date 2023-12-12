<?php

namespace App\Filament\Resources\SubGenericaNivel2Resource\Pages;

use App\Filament\Resources\SubGenericaNivel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubGenericaNivel2 extends CreateRecord
{
    protected static string $resource = SubGenericaNivel2Resource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
