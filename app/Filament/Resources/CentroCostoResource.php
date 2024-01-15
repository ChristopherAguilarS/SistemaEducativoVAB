<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentroCostoResource\Pages;
use App\Filament\Resources\CentroCostoResource\RelationManagers;
use App\Models\CentroCosto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CentroCostoResource extends Resource
{
    protected static ?string $model = CentroCosto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')->required(),
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('area_id')
                ->relationship(name: 'area', titleAttribute: 'descripcion')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('centro_costo_id')->label('Centro de Costo Superior')
                    ->relationship('centro_costo_superior', 'descripcion',fn (Builder $query) => $query->where('estado',1))
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->codigo} - {$record->descripcion}")
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->label('Codigo')->sortable()->searchable(),             
                Tables\Columns\TextColumn::make('descripcion')->label('Sub Generica Nivel 2')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('area.descripcion')->label('Area')
                ->getStateUsing(fn ($record)=> $record->area->descripcion),
                Tables\Columns\TextColumn::make('centro_costo_superior.descripcion')->label('Centro de Costo Superior')
                ->getStateUsing(fn ($record)=> ($record->centro_costo_superior!=null) ? $record->centro_costo_superior->codigo.' - '.$record->centro_costo_superior->descripcion : ''),
                Tables\Columns\IconColumn::make('estado')->boolean()->sortable()
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
            'index' => Pages\ListCentroCostos::route('/'),
            'create' => Pages\CreateCentroCosto::route('/create'),
            'edit' => Pages\EditCentroCosto::route('/{record}/edit'),
        ];
    }    
}
