<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres',
        'ape_pat',
        'ape_mat',
        'tipo_documento',
        'nro_documento',
        'genero',
        'telefono',
        'estado',
    ];

    protected function nTipoDocumento(): Attribute
    {
        $resultado = null;
        if($this->tipo_documento == 'dni'){
            $resultado =  'DNI';
        }
        elseif($this->tipo_documento == 'carnet_extranjeria'){
            $resultado = 'Carnet de Extranjeria';
        }
        elseif($this->tipo_documento == 'pasaporte'){
            $resultado = 'Pasaporte';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }
    
}
