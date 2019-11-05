<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('idcreateruser');
            $table->timestamps();
        });
        Schema::create('componentes_anuncios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idanuncio');
            $table->string('tipo');
            $table->string('name');
            $table->string('properties');
            $table->string('dirroot');
            $table->integer('status');
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
        Schema::dropIfExists('anuncios');
    }
}
