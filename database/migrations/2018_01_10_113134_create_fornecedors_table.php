<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao','120');
            $table->enum('tipo_pessoa',['fisica','juridica']);
            $table->string('cpf_cnpj','20')->nullable();
            // $table->string('cnpj','20')->nullable();
            $table->string('banco','20')->nullable();
            $table->string('agencia','20')->nullable();
            $table->string('conta','20')->nullable();
            $table->string('passnf','20')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedors');
    }
}
