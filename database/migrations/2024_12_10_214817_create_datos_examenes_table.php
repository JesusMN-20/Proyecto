<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_examenes', function (Blueprint $table) {
            $table->id();
            //Propio
            $table->foreignId('examen_id')->constrained('examenes')->onDelete('cascade');
            $table->string('nombre', 255);
            $table->enum('tipo_dato', ['numérico', 'texto']);
            $table->string('unidad_medida', 100)->nullable();
            $table->float('rango_min')->nullable();
            $table->float('rango_max')->nullable();

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
        Schema::dropIfExists('datos_examenes');
    }
}
