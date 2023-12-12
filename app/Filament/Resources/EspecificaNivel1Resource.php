<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspecificaNivel1Resource\Pages;
use App\Filament\Resources\EspecificaNivel1Resource\RelationManagers;
use App\Models\EspecificaNivel1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EspecificaNivel1Resource extends Resource
{
    protected static ?string $model = EspecificaNivel1::class;

    protected static ?string $modelLabel = 'Especifica Nivel 1';
    protected static ?string $pluralModelLabel = 'Especificas Nivel 1';
    protected static ?string $navigationIcon = 'phosphor-number-circle-five-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('sub_generica_nivel_2_id')
                ->relationship(name: 'subgenericanivel2', titleAttribute: 'descripcion')
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
                Tables\Columns\TextColumn::make('descripcion')->label('Especifica Nivel 1')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('subgenericanivel2.descripcion')->label('Sub Generica Nivel 2')
                ->getStateUsing(fn ($record)=> $record->subgenericanivel2->codigo.' - '.$record->subgenericanivel2->descripcion),
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
                ->action(function (EspecificaNivel1 $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Especifica Nivel 1 dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (EspecificaNivel1 $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (EspecificaNivel1 $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Especifica Nivel 1 dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (EspecificaNivel1 $record): bool => $record->estado == true)
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
            'index' => Pages\ListEspecificaNivel1s::route('/'),
            'create' => Pages\CreateEspecificaNivel1::route('/create'),
            'edit' => Pages\EditEspecificaNivel1::route('/{record}/edit'),
        ];
    }    
}
