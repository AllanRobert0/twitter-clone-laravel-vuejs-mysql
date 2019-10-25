<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComentarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_comentarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('texto_comentario');          
            $table->bigInteger('usuario_id')->unsigned()->index();
            $table->bigInteger('tweet_id')->unsigned()->index();
            $table->foreign('usuario_id')->references('id')->on('table_usuarios')->onDelete('cascade');
            $table->foreign('tweet_id')->references('id')->on('table_tweets')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_comentarios');
    }
}
