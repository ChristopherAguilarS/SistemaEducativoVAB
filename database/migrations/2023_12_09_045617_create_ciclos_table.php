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
        Schema::create('ciclos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_ciclo_id'); 
            $table->foreign('tipo_ciclo_id')->references('id')->on('tipo_ciclos');
            $table->unsignedInteger('año_academico_id'); 
            $table->foreign('año_academico_id')->references('id')->on('año_academicos');
            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');            
            $table->boolean('condicion');
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
        Schema::dropIfExists('ciclos');
    }
};
