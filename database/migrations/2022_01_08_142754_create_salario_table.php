<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salario', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_colaborador')->unsigned();
            $table->foreign('id_colaborador')->references('id')->on('colaborador')->onDelete('cascade')->onUpdate('cascade');
            $table->double('salario', 8, 2);
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
        Schema::dropIfExists('salario');
    }
}
