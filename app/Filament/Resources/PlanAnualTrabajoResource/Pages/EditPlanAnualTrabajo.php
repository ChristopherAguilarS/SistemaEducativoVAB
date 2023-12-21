<?php

namespace App\Filament\Resources\PlanAnualTrabajoResource\Pages;

use App\Filament\Resources\PlanAnualTrabajoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanAnualTrabajo extends EditRecord
{
    protected static string $resource = PlanAnualTrabajoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
