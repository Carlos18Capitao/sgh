<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setors')->onDelete('cascade');
            $table->integer('qtd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandas');
    }
}
