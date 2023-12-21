<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
