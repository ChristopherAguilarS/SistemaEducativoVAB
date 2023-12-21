<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
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
        'sub_generica_nivel_1_id',
        'estado',
        'created_by',
        'updated_by',
    ];    
    
}
