<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenericaResource\Pages;
use App\Filament\Resources\GenericaResource\RelationManagers;
use App\Models\Generica;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GenericaResource extends Resource
{
    protected static ?string $model = Generica::class;

    protected static ?string $navigationIcon = 'phosphor-number-circle-two-fill';

    protected static ?string $navigationGroup = 'Configuracion_Clasificadores';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('tipo_transaccion_id')
                ->relationship(name: 'tipo_transaccion', titleAttribute: 'descripcion')
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
                Tables\Columns\TextColumn::make('descripcion')->label('Generica')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tipo_transaccion.descripcion')->label('Tipo Transaccion')
                ->getStateUsing(fn ($record)=> $record->tipo_transaccion->codigo.' - '.$record->tipo_transaccion->descripcion),
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
                ->action(function (Generica $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Generica dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (Generica $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (Generica $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Generica dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (Generica $record): bool => $record->estado == true)
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
            'index' => Pages\ListGenericas::route('/'),
            'create' => Pages\CreateGenerica::route('/create'),
            'edit' => Pages\EditGenerica::route('/{record}/edit'),
        ];
    }    
}
