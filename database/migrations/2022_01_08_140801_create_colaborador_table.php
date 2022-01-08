<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaborador', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nome', 100);
            $table->string('email', 100)->unique()->comment('Email unico do colaborador');
            $table->string('cpf', 11)->unique()->comment('CPF unico do colaborador'); 
            $table->string('rg', 9);
            $table->date('nascimento');
            $table->integer('cep');
            $table->string('endereco', 255);
            $table->string('numero', 9);
            $table->string('cidade', 100);
            $table->char('estado', 2);
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
        Schema::dropIfExists('colaborador');
    }
}
