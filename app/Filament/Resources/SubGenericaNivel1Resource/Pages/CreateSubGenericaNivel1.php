<?php

namespace App\Filament\Resources\SubGenericaNivel1Resource\Pages;

use App\Filament\Resources\SubGenericaNivel1Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubGenericaNivel1 extends CreateRecord
{
    protected static string $resource = SubGenericaNivel1Resource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
