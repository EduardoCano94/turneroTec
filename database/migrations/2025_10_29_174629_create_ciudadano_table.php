<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ciudadano', function (Blueprint $table) {
            $table->id();
            $table->string('CLAVEIDENTIFICACION')->unique();
            $table->string('NOMBRE');
            $table->string('APELLIDO');
            $table->boolean('DISPONIBLE')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ciudadano');
    }
};