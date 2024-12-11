<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            //Propio
            $table->string('codigo', 20)->unique();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->enum('estado', ['proceso', 'pausado', 'cancelado', 'finalizado'])->default('proceso');
            $table->enum('tipo', ['emergencia', 'rutina'])->default('rutina');
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
        Schema::dropIfExists('solicitudes');
    }
}
