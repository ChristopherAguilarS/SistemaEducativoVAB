<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConceptoIngresoResource\Pages;
use App\Filament\Resources\ConceptoIngresoResource\RelationManagers;
use App\Models\ConceptoIngreso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConceptoIngresoResource extends Resource
{
    protected static ?string $model = ConceptoIngreso::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationParentItem = 'Cuentas';

    protected static ?string $navigationGroup = 'Pagos';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('tipo')->label('Pago con Vigencia')
                            ->options([
                                '0' => 'No',
                                '1' => 'Si'
                            ])->required()
                            ->reactive(),
                Forms\Components\DatePicker::make('fecha_vigencia')
                ->visible(function(callable $get){
                    if($get('tipo') != null){
                        if($get('tipo') == '0'){
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                    else{
                        return false; 
                    }
                }),                
                Forms\Components\TextInput::make('monto')->numeric()
                ->inputMode('decimal')->prefix('S/.')
                ->visible(function(callable $get){
                    if($get('tipo') != null){
                        if($get('tipo') == '0'){
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                    else{
                        return false;
                    }
                }), 
                Forms\Components\Select::make('tipo_ingreso_id')->label('Tipo de Ingreso')
                ->relationship('tipoIngreso', 'descripcion')
                ->preload()
                ->required(),  
                Forms\Components\Select::make('especifica_nivel_2_id')->label('Especifica Nivel 2')
                ->relationship('especificanivel2', 'descripcion',fn (Builder $query) => $query->where('codigo', 'LIKE', '1'.'%'))
                ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->codigo} {$record->descripcion}")
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
            'index' => Pages\ListConceptoIngresos::route('/'),
            'create' => Pages\CreateConceptoIngreso::route('/create'),
            'edit' => Pages\EditConceptoIngreso::route('/{record}/edit'),
        ];
    }    
}
