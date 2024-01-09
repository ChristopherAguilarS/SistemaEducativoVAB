<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanAnualTrabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'año',
        'nombre',
        'ruc',
        'resolucion',
        'tipo_gestion',
        'direccion',
        'lista_servicios',
        'nombre_director',
        'vision',
        'mision',
        'estado',
        'created_by',
        'updated_by',
    ];

    public function actividades(): HasMany
    {
        return $this->hasMany('App\Models\ActividadOperativa', 'plan_anual_trabajo_id', 'id');
    }

}
