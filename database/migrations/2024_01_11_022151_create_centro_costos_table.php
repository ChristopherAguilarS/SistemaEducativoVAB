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
        Schema::create('centro_costos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('descripcion',1000);
            $table->unsignedInteger('area_id'); 
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedInteger('centro_costo_id')->nullable(); 
            $table->foreign('centro_costo_id')->references('id')->on('centro_costos');
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
        Schema::dropIfExists('centro_costos');
    }
};
