<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActividadOperativa extends Model
{
    protected $table = 'actividades_operativas';
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'plan_anual_trabajo_id',
        'estado',
        'created_by',
        'updated_by',
    ];  
    
    public function plan_anual_trabajo(): BelongsTo
    {
        return $this->belongsTo('App\Models\PlanAnualTrabajo', 'plan_anual_trabajo_id', 'id');
    }
}
