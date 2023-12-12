<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EspecificaNivel2 extends Model
{
    protected $table = 'especificas_nivel_2';
    use HasFactory;
    protected $fillable = [
        'especifica_nivel_1_id',
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function especificanivel1(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel1', 'especifica_nivel_1_id', 'id');
    }
}
