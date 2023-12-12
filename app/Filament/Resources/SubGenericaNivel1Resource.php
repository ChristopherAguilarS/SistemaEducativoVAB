<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubGenericaNivel1Resource\Pages;
use App\Filament\Resources\SubGenericaNivel1Resource\RelationManagers;
use App\Models\SubGenericaNivel1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubGenericaNivel1Resource extends Resource
{
    protected static ?string $model = SubGenericaNivel1::class;

    protected static ?string $modelLabel = 'Sub Generica Nivel 1';
    protected static ?string $pluralModelLabel = 'Sub Genericas Nivel 1';
    protected static ?string $navigationIcon = 'phosphor-number-circle-three-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('generica_id')
                ->relationship(name: 'generica', titleAttribute: 'descripcion')
                ->searchable()
                ->preload()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->label('Codigo')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('descripcion')->label('SubGenerica')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('generica.descripcion')->label('Generica')
                ->getStateUsing(fn ($record)=> $record->generica->codigo.' - '.$record->generica->descripcion),
                Tables\Columns\IconColumn::make('estado')->boolean()->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make(name: 'Dar de Alta')
                ->icon('heroicon-s-hand-thumb-up')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de alta?')
                ->color( color: 'success')
                ->action(function (SubGenericaNivel1 $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Sub Generica Nivel 1 dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (SubGenericaNivel1 $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (SubGenericaNivel1 $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Sub Generica Nivel 1 dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (SubGenericaNivel1 $record): bool => $record->estado == true)
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
            'index' => Pages\ListSubGenericaNivel1s::route('/'),
            'create' => Pages\CreateSubGenericaNivel1::route('/create'),
            'edit' => Pages\EditSubGenericaNivel1::route('/{record}/edit'),
        ];
    }    
}
