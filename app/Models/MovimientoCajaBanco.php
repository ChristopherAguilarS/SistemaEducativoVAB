<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoCajaBanco extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'fecha',
        'cuenta_id',
        'descripcion',
        'tipo',
        'monto',
        'estado',
        'created_by',
        'updated_by'
    ];

    protected function nTipo(): Attribute
    {
        $resultado = null;
        if($this->tipo == 1){
            $resultado =  'Deudor';
        }
        else{
            $resultado = 'Acreedor';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id', 'id');
    }
}
