<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EspecificaNivel2Resource\Pages;
use App\Filament\Resources\EspecificaNivel2Resource\RelationManagers;
use App\Models\EspecificaNivel2;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EspecificaNivel2Resource extends Resource
{
    protected static ?string $model = EspecificaNivel2::class;

    protected static ?string $modelLabel = 'Especifica Nivel 2';
    protected static ?string $pluralModelLabel = 'Especificas Nivel 2';

    protected static ?string $navigationIcon = 'phosphor-number-circle-six-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('especifica_nivel_1_id')
                ->relationship(name: 'EspecificaNivel1', titleAttribute: 'descripcion')
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
                Tables\Columns\TextColumn::make('descripcion')->label('Especifica Nivel 2')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('EspecificaNivel1.descripcion')->label('Especifica Nivel 1')
                ->getStateUsing(fn ($record)=> $record->EspecificaNivel1->codigo.' - '.$record->EspecificaNivel1->descripcion),
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
                ->action(function (EspecificaNivel2 $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Especifica Nivel 2 dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (EspecificaNivel2 $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (EspecificaNivel2 $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Especifica Nivel 2 dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (EspecificaNivel2 $record): bool => $record->estado == true)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateDescription('Crea uno nuevo');
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
            'index' => Pages\ListEspecificaNivel2s::route('/'),
            'create' => Pages\CreateEspecificaNivel2::route('/create'),
            'edit' => Pages\EditEspecificaNivel2::route('/{record}/edit'),
        ];
    }    
}
