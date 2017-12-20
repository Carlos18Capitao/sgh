<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstoqueProdutoSaida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('produto_saidas', function ($table) {
           $table->integer('estoque_id')->unsigned()->default(1); //DEFAULT PARA ATUALIZAR OS JÁ CADASTRADOS
           $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
         });
    }
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('produto_saidas',function($t){
           $t->dropColumn('estoque_id');
       });
     }
   }
