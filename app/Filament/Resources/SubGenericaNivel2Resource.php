<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubGenericaNivel2Resource\Pages;
use App\Filament\Resources\SubGenericaNivel2Resource\RelationManagers;
use App\Models\SubGenericaNivel2;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubGenericaNivel2Resource extends Resource
{
    protected static ?string $model = SubGenericaNivel2::class;

    protected static ?string $modelLabel = 'Sub Generica Nivel 2';
    protected static ?string $pluralModelLabel = 'Sub Genericas Nivel 2';

    protected static ?string $navigationIcon = 'phosphor-number-circle-four-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('sub_generica_nivel_1_id')
                ->relationship(name: 'subgenericanivel1', titleAttribute: 'descripcion')
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
                Tables\Columns\TextColumn::make('descripcion')->label('Sub Generica Nivel 2')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('subgenericanivel1.descripcion')->label('Sub Generica Nivel 1')
                ->getStateUsing(fn ($record)=> $record->subgenericanivel1->codigo.' - '.$record->subgenericanivel1->descripcion),
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
                ->action(function (SubGenericaNivel2 $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Sub Generica Nivel 1 dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (SubGenericaNivel2 $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (SubGenericaNivel2 $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Sub Generica Nivel 1 dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (SubGenericaNivel2 $record): bool => $record->estado == true)
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
            'index' => Pages\ListSubGenericaNivel2s::route('/'),
            'create' => Pages\CreateSubGenericaNivel2::route('/create'),
            'edit' => Pages\EditSubGenericaNivel2::route('/{record}/edit'),
        ];
    }    
}
