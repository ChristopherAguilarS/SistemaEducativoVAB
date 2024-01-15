<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indicador extends Model
{
    protected $table = 'indicadores';
    use HasFactory;
    protected $fillable = [
        'actividad_operativa_id',
        'codigo',
        'descripcion',
        'meta',
        'responsables',
        'bienes_servicios',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
        'especifica_nivel_2_id',
        'centro_costo_id',
        'estado',
        'created_by',
        'updated_by',
    ];    
    

    public function actividad_operativa(): BelongsTo
    {
        return $this->belongsTo('App\Models\ActividadOperativa', 'actividad_operativa_id', 'id');
    }

    public function especificanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel2', 'especifica_nivel_2_id', 'id');
    }

    public function centro_costo(): BelongsTo
    {
        return $this->belongsTo('App\Models\CentroCosto', 'centro_costo_id', 'id');
    }
}
