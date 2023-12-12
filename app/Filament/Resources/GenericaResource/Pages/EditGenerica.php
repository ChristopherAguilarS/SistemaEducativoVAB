<?php

namespace App\Filament\Resources\GenericaResource\Pages;

use App\Filament\Resources\GenericaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenerica extends EditRecord
{
    protected static string $resource = GenericaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
