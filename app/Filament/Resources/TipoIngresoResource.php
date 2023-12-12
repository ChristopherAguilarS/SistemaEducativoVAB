<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoIngresoResource\Pages;
use App\Filament\Resources\TipoIngresoResource\RelationManagers;
use App\Models\TipoIngreso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoIngresoResource extends Resource
{
    protected static ?string $model = TipoIngreso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pagos';

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
                Tables\Columns\TextColumn::make('descripcion')->label('Descripcion')->sortable()->searchable(),
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
            'index' => Pages\ListTipoIngresos::route('/'),
            'create' => Pages\CreateTipoIngreso::route('/create'),
            'edit' => Pages\EditTipoIngreso::route('/{record}/edit'),
        ];
    }    
}
