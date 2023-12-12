<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTransaccion extends Model
{
    protected $table = 'tipo_transacciones';
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
    ];
}
