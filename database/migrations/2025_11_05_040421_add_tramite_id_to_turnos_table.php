<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->unsignedBigInteger('tramite_id')->nullable()->after('id_ciudadano');
            
            $table->foreign('tramite_id')
                  ->references('id')
                  ->on('tramites')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['tramite_id']);
            $table->dropColumn('tramite_id');
        });
    }
};