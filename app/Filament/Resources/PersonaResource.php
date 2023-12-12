<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonaResource\Pages;
use App\Filament\Resources\PersonaResource\RelationManagers;
use App\Models\Persona;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonaResource extends Resource
{
    protected static ?string $model = Persona::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Label')
                ->tabs([
                    Tabs\Tab::make('Información Personal')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        Grid::make(3)
                        ->schema([
                            Forms\Components\TextInput::make('nombres')->label('Nombres')->required(),
                            Forms\Components\TextInput::make('ape_pat')->label('Ap. Paterno')->required(),
                            Forms\Components\TextInput::make('ape_mat')->label('Ap. Materno')->required(),
                            ])->columns([
                                'sm' => 1,
                                'xl' => 3,
                                '2xl' => 3,
                            ]),
                        Grid::make(4)
                        ->schema([
                            Forms\Components\Select::make('tipo_documento')->label('Tipo de Documento')->required()
                            ->options([
                                'dni' => 'DNI',
                                'carnet_extranjeria' => 'CARNET DE EXTRANJERIA',
                                'pasaporte' => 'PASAPORTE'
                            ]),
                            Forms\Components\TextInput::make('nro_documento')->label('N° de Documento')->required()
                            ->unique(table: Persona::class),
                            Forms\Components\Select::make('genero')
                            ->options([
                                '0' => 'Masculino',
                                '1' => 'Femenino'
                            ])->required(),
                            Forms\Components\TextInput::make('telefono')->required(),
                        ]),
                    ]),
                ])->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')
                ->getStateUsing(fn ($record)=> $record->nombres.' '.$record->ape_pat.' '.$record->ape_mat),
                Tables\Columns\TextColumn::make('ntipodocumento')->label('Tipo Documento'),
                Tables\Columns\TextColumn::make('nro_documento')->label('N° Documento'),
                Tables\Columns\IconColumn::make('genero')                
                ->icon(fn (string $state): string => match ($state) {
                    '1' => 'gmdi-female',
                    '0' => 'gmdi-male',
                })
                ->color(fn (string $state): string => match ($state) {
                    '1' => 'pink',
                    '0' => 'info'
                })
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
                ->action(function (Persona $record){
                    $record->estado = 1;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Persona dado de Alta exitosamente')
                    ->send();
                })
                ->visible(fn (Persona $record): bool => $record->estado == false),
                Tables\Actions\Action::make(name: 'Dar de Baja')
                ->icon('heroicon-s-hand-thumb-down')
                ->requiresConfirmation()
                ->modalSubheading('¿Esta seguro de dar de baja?')
                ->color( color: 'danger')
                ->action(function (Persona $record){
                    $record->estado = 0;
                    $record->save();
                    Notification::make()
                    ->title('Actualizado exitosamente')
                    ->success()
                    ->body('Persona dado de Baja exitosamente')
                    ->send();
                })
                ->visible(fn (Persona $record): bool => $record->estado == true)
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
            'index' => Pages\ListPersonas::route('/'),
            'create' => Pages\CreatePersona::route('/create'),
            'edit' => Pages\EditPersona::route('/{record}/edit'),
        ];
    }    
}
