<?php

namespace App\Filament\Resources\EspecificaNivel2Resource\Pages;

use App\Filament\Resources\EspecificaNivel2Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEspecificaNivel2 extends CreateRecord
{
    protected static string $resource = EspecificaNivel2Resource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
