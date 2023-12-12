<?php

namespace App\Filament\Resources\EspecificaNivel1Resource\Pages;

use App\Filament\Resources\EspecificaNivel1Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEspecificaNivel1 extends CreateRecord
{
    protected static string $resource = EspecificaNivel1Resource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
