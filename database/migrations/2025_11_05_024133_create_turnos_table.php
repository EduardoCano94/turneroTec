<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->date('fecha');
            $table->text('descripcion');
            $table->enum('estado', ['En espera', 'Ya atendido'])->default('En espera');
            $table->unsignedBigInteger('id_ciudadano');
            $table->timestamps();

            // Relación con ciudadano
            $table->foreign('id_ciudadano')
                  ->references('id')
                  ->on('ciudadano')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('turnos');
    }
};