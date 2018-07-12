<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_estoques', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('produto_id')->unsigned();
          $table->foreign('produto_id')->references('id')->on('produtos');
          $table->integer('estoque_id')->unsigned();
          $table->foreign('estoque_id')->references('id')->on('estoques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_estoques');
    }
}
