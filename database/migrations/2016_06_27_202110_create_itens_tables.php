<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItensTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->double('quantidade');
            $table->string('valor');
            $table->integer('order');
            $table->integer('ordem_compra_id')->unsigned();
            $table->timestamps();

            $table->foreign('ordem_compra_id')->references('id')->on('ordens_compra')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itens');
    }
}
