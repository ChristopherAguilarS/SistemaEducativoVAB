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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actividad_operativa_id'); 
            $table->foreign('actividad_operativa_id')->references('id')->on('actividades_operativas');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('meta');
            $table->string('responsables');
            $table->string('bienes_servicios');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('presupuesto', $precision = 10, $scale = 2);
            $table->unsignedInteger('sub_generica_nivel_1_id'); 
            $table->foreign('sub_generica_nivel_1_id')->references('id')->on('sub_genericas_nivel_1');
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
        Schema::dropIfExists('indicadores');
    }
};
