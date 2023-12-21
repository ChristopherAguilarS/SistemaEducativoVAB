<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadOperativa extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'plan_anual_trabajo_id',
        'estado',
        'created_by',
        'updated_by',
    ];       
}
