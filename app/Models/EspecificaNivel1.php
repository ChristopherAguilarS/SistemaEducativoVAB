<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EspecificaNivel1 extends Model
{
    protected $table = 'especificas_nivel_1';
    use HasFactory;
    protected $fillable = [
        'sub_generica_nivel_2_id',
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function subgenericanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\SubGenericaNivel2', 'sub_generica_nivel_2_id', 'id');
    }

}
