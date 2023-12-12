<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Generica extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_transaccion_id',
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function tipo_transaccion(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoTransaccion', 'tipo_transaccion_id', 'id');
    }
}
