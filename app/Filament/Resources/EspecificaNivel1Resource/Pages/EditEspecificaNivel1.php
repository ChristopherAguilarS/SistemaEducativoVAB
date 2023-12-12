<?php

namespace App\Filament\Resources\EspecificaNivel1Resource\Pages;

use App\Filament\Resources\EspecificaNivel1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEspecificaNivel1 extends EditRecord
{
    protected static string $resource = EspecificaNivel1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
