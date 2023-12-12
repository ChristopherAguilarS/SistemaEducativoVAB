<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoTransaccionResource\Pages;
use App\Filament\Resources\TipoTransaccionResource\RelationManagers;
use App\Models\TipoTransaccion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoTransaccionResource extends Resource
{
    protected static ?string $model = TipoTransaccion::class;

    protected static ?string $modelLabel = 'Tipo de Transaccion';
    protected static ?string $pluralModelLabel = 'Tipos de Transacciones';
    protected static ?string $navigationIcon = 'phosphor-number-circle-one-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([                
                Forms\Components\TextInput::make('descripcion')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->label('Codigo')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('descripcion')->label('Descripcion')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('estado')->boolean()->sortable(),
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
                ->action(function (TipoTransaccion $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('TipoTransaccion dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (TipoTransaccion $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (TipoTransaccion $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('TipoTransaccion dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (TipoTransaccion $record): bool => $record->estado == true)
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
            'index' => Pages\ListTipoTransaccions::route('/'),
            'create' => Pages\CreateTipoTransaccion::route('/create'),
            'edit' => Pages\EditTipoTransaccion::route('/{record}/edit'),
        ];
    }    
}
