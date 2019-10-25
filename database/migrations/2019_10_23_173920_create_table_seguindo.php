<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSeguindo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_seguindo', function (Blueprint $table) {
            $table->bigIncrements('id');                      
            $table->bigInteger('usuario_id')->unsigned()->index();
            $table->bigInteger('usuario_seguido_id')->unsigned()->index();
            $table->foreign('usuario_id')->references('id')->on('table_usuarios')->onDelete('cascade');
            $table->foreign('usuario_seguido_id')->references('id')->on('table_usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('table_seguindo');
    }
}
