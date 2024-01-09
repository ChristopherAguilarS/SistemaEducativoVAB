<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nro_estudiante',
        'persona_id',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo('App\Models\Persona', 'persona_id', 'id');
    }
}
