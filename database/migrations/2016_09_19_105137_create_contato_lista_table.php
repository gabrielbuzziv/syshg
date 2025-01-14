<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatoListaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contato_lista', function (Blueprint $table) {
            $table->integer('contato_id')->unsigned();
            $table->integer('lista_id')->unsigned();

            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade');
            $table->foreign('lista_id')->references('id')->on('listas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contato_lista');
    }
}
