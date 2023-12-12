<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'tipo',
        'estado',
        'created_by',
        'updated_by'
    ];
}
