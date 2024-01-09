<?php

namespace App\Filament\Resources\PlanAnualTrabajoResource\Pages;

use App\Filament\Resources\PlanAnualTrabajoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlanAnualTrabajo extends CreateRecord
{
    protected static string $resource = PlanAnualTrabajoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['estado'] = 1;
        $data['created_by'] = auth()->id();

        return $data;
    }
}
