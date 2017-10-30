<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('nome','120');
            $table->string('cnes','30')->nullable();
            $table->boolean('assistente');
            $table->boolean('executante');
            $table->integer('ala_id')->unsigned();
            $table->foreign('ala_id')->references('id')->on('alas')->onDelete('cascade');
            $table->integer('tipo_prestador_id')->unsigned();
            $table->foreign('tipo_prestador_id')->references('id')->on('tipo_prestadors')->onDelete('cascade');
            $table->string('telefone','50')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadors');
    }
}
