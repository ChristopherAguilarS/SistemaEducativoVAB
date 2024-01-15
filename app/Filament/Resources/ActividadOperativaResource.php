<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActividadOperativaResource\Pages;
use App\Filament\Resources\ActividadOperativaResource\RelationManagers;
use App\Models\ActividadOperativa;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActividadOperativaResource extends Resource
{
    protected static ?string $model = ActividadOperativa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('codigo')->required(),
                            Forms\Components\Select::make('plan_anual_trabajo_id')
                            ->relationship('plan_anual_trabajo', 'nombre',fn (Builder $query) => $query->where('estado', 1))
                                ->getOptionLabelFromRecordUsing(fn (Model $record) => "PAT - {$record->año}")
                                ->searchable()
                                ->preload()
                                ->required(),
                            ]),
                        
                            Forms\Components\Textarea::make('descripcion')->required()->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo'),
                Tables\Columns\TextColumn::make('descripcion')->limit(70),
                Tables\Columns\TextColumn::make('plan_anual_trabajo.año')->label('Plan Anual de Trabajo')
                ->getStateUsing(fn ($record)=> 'PAT - '.$record->plan_anual_trabajo->año),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActividadOperativas::route('/'),
            'create' => Pages\CreateActividadOperativa::route('/create'),
            'edit' => Pages\EditActividadOperativa::route('/{record}/edit'),
        ];
    }    
}
