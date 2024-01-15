<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndicadorResource\Pages;
use App\Filament\Resources\IndicadorResource\RelationManagers;
use App\Models\Indicador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndicadorResource extends Resource
{
    protected static ?string $model = Indicador::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')->required(),
                Forms\Components\Select::make('actividad_operativa_id')
                ->relationship('actividad_operativa', 'descripcion',fn (Builder $query) => $query->where('estado', 1))
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->codigo} - {$record->descripcion}")
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Textarea::make('descripcion')->required()->columnSpan(2),
                Forms\Components\TextInput::make('responsables')->required()->columnSpan(2),
                Forms\Components\Textarea::make('metas')->required()->columnSpan(2),
                Forms\Components\Textarea::make('bienes_servicios')->required()->columnSpan(2),
                Forms\Components\DatePicker::make('fecha_inicio')->label('Fecha de Inicio')->required(),
                Forms\Components\DatePicker::make('fecha_fin')->label('Fecha de Fin')->required(),
                Forms\Components\Select::make('centro_costo_id')->label('Centro de Costo')
                ->relationship('centro_costo', 'descripcion',fn (Builder $query) => $query->where('estado', 1))
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->codigo} - {$record->descripcion}")
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('especifica_nivel_2_id')->label('Especifica 2 nivel')
                ->relationship('especificanivel2', 'descripcion',fn (Builder $query) => $query->where('estado', 1))
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->codigo} - {$record->descripcion}")
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListIndicadors::route('/'),
            'create' => Pages\CreateIndicador::route('/create'),
            'edit' => Pages\EditIndicador::route('/{record}/edit'),
        ];
    }    
}
