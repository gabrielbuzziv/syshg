<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrcamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('cliente');
            $table->string('placa');
            $table->string('veiculo');
            $table->string('km');
            $table->string('observacao');
            $table->string('telefone_comercial');
            $table->string('telefone_residencial');
            $table->string('celular');
            $table->string('condicoes_pagamento');
            $table->integer('user_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orcamentos');
    }
}
