<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoCajaBancoResource\Pages;
use App\Filament\Resources\MovimientoCajaBancoResource\RelationManagers;
use App\Filament\Resources\MovimientoCajaBancoResource\Widgets\MovimientoCajaBancoview;
use App\Filament\Resources\MovimientoCajaBancoResource\Widgets\StatsOverview;
use App\Models\Cuenta;
use App\Models\MovimientoCajaBanco;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MovimientoCajaBancoResource extends Resource
{
    protected static ?string $model = MovimientoCajaBanco::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Contabilidad';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('fecha'),
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\Select::make('tipo')->options([
                    1 => 'Deudor',
                    2 => 'Acreedor',
                    ])->required(),
                Forms\Components\TextInput::make('monto')->required(),                
                Forms\Components\Select::make('cuenta_id')->label('Cuenta')
                    ->relationship('cuenta', 'descripcion',fn (Builder $query) => $query->where('codigo', 'LIKE', '1'.'%'))
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
                Tables\Columns\TextColumn::make('fecha')->date('d/m/Y')->label('Fecha')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('ntipo')->label('Movimiento')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cuenta.descripcion')->label('Cuenta')
                ->getStateUsing(fn ($record)=> $record->cuenta->codigo.' - '.$record->cuenta->descripcion),
                Tables\Columns\TextColumn::make('monto')->label('Monto')->money('S./'),
                Tables\Columns\IconColumn::make('estado')->boolean()->sortable(),
            ])
            ->filters([
                Filter::make('periodo')
                ->form([
                    DatePicker::make('desde'),
                    DatePicker::make('hasta'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['desde'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha', '>=', $date),
                        )
                        ->when(
                            $data['hasta'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        // Pass a string
                        ExcelExport::make()->withFilename(date('Y-m-d') . ' - export')
                        ->withColumns([
                            Column::make('fecha')
                            ->formatStateUsing(fn ($state) => date('d/m/Y',strtotime($state))),
                            Column::make('descripcion'),
                            Column::make('cuenta.descripcion'),
                            Column::make('nTipo'),
                            Column::make('monto'),
                        ]),
                    ])
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

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovimientoCajaBancos::route('/'),
            'create' => Pages\CreateMovimientoCajaBanco::route('/create'),
            'edit' => Pages\EditMovimientoCajaBanco::route('/{record}/edit'),
        ];
    }    
}
