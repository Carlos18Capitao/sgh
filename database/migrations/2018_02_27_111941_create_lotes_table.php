<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('lote','30')->nullable();
            $table->date('validade')->nullable();
            $table->biginteger('qtd');
            $table->integer('produto_entrada_id')->unsigned()->nullable();
            $table->integer('produto_saida_id')->unsigned()->nullable();
            $table->integer('produto_id')->unsigned();

            $table->foreign('produto_entrada_id')->references('id')->on('produto_entradas')->onDelete('cascade');
            $table->foreign('produto_saida_id')->references('id')->on('produto_saidas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
