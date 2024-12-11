<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_examenes', function (Blueprint $table) {
            $table->id();
            //Propio
            $table->foreignId('detalle_solicitud_id')->constrained('detalle_solicitudes')->onDelete('cascade');
            $table->foreignId('dato_examen_id')->constrained('datos_examenes')->onDelete('cascade');
            $table->text('valor')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados_examenes');
    }
}
