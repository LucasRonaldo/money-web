<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('email',100)->unique()->nullable(false);
            $table->string('cpf',11)->unique()->nullable(false);
            $table->string('nome',100);
            $table->string('celular',100);
            $table->date('dataNascimento');
            $table->text('cidade',10000);
            $table->string('estado',100);
            $table->string('pais',100);
            $table->string('rua',100);
            $table->string('numero',100);
            $table->string('bairro',100);
            $table->string('cep',100);
            $table->string('complemento',100);
            $table->string('password',100);
            $table->string('confirm_password',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
