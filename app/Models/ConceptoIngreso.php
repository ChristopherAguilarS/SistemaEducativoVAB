<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConceptoIngreso extends Model
{
    protected $table = 'concepto_ingresos';
    use HasFactory;
    protected $fillable = [
        'fecha_vigencia',
        'descripcion',
        'monto',
        'especifica_nivel_2_id',
        'tipo_ingreso_id',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function especificanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel2', 'especifica_nivel_2_id', 'id');
    }

    public function tipoIngreso(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoIngreso', 'tipo_ingreso_id', 'id');
    }
}
