<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanAnualTrabajoResource\Pages;
use App\Filament\Resources\PlanAnualTrabajoResource\RelationManagers\ActividadesRelationManager;
use App\Models\PlanAnualTrabajo;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanAnualTrabajoResource extends Resource
{
    protected static ?string $model = PlanAnualTrabajo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                        Grid::make(6)
                        ->schema([
                            Forms\Components\Select::make('año')->options([
                                    2021 => '2021',
                                    2022 => '2022',
                                    2023 => '2023',
                                    2024 => '2024',
                                    2025 => '2025',
                                    2026 => '2026',
                                    2027 => '2027',
                                    2028 => '2028',
                                    2029 => '2029',
                                    ])->required(),
                            Forms\Components\TextInput::make('nombre')->required()->columnSpan(3),
                            Forms\Components\TextInput::make('ruc')->required(),
                            ]),
                            Forms\Components\TextInput::make('resolucion')->required(),
                        Grid::make(2)
                            ->schema([
                                    Forms\Components\TextInput::make('direccion')->required(),
                                    Forms\Components\TextInput::make('nombre_director')->required()
                            ]),
                        Grid::make(2)
                            ->schema([
                            Forms\Components\Textarea::make('lista_servicios')->label('Lista de servicios')->required(),                    
                            Forms\Components\Textarea::make('tipo_gestion')->label('Tipo de gestion')->required(),
                        ]),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('año'),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\IconColumn::make('estado')->boolean()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlanAnualTrabajos::route('/'),
            'create' => Pages\CreatePlanAnualTrabajo::route('/create'),
            'edit' => Pages\EditPlanAnualTrabajo::route('/{record}/edit'),
        ];
    }    
}
