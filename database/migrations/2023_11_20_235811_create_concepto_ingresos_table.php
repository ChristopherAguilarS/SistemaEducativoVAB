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
        Schema::create('concepto_ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->date('fecha_vigencia')->nullable();
            $table->decimal('monto', $precision = 8, $scale = 2);
            $table->unsignedInteger('especifica_nivel_2_id'); 
            $table->foreign('especifica_nivel_2_id')->references('id')->on('especificas_nivel_2');
            $table->unsignedInteger('tipo_ingreso_id'); 
            $table->foreign('tipo_ingreso_id')->references('id')->on('tipo_ingresos');
            $table->boolean('estado');
            $table->boolean('tipo');
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
        Schema::dropIfExists('concepto_ingresos');
    }
};
