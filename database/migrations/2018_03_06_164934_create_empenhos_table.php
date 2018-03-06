<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpenhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empenhos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nrempenho','20');
            $table->date('dataemissao');
            $table->float('valortotal');
            $table->enum('modalidade', array('Global', 'Ordinário'));
            $table->string('fonte','50');
            $table->string('plano','50');
            $table->integer('processo_id')->unsigned();
            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empenhos');
    }
}
