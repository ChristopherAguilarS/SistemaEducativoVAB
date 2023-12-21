<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plan_anual_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('año');
            $table->string('nombre');
            $table->string('ruc');
            $table->string('resolucion');
            $table->string('tipo_gestion');
            $table->string('direccion');
            $table->string('lista_servicios');
            $table->string('nombre_director');
            $table->string('vision');
            $table->string('mision');
            $table->boolean('estado');            
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_anual_trabajos');
    }
};
