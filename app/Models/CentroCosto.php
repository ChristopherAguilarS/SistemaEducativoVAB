<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CentroCosto extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'area_id',
        'centro_costo_id',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }

    public function centro_costo_superior(): BelongsTo
    {
        return $this->belongsTo('App\Models\CentroCosto', 'centro_costo_id', 'id');
    }
}
