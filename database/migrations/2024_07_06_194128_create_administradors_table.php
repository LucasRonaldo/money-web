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
        Schema::create('administradors', function (Blueprint $table) {
            $table->id();
            $table->string('email',100)->unique()->nullable(false);
            $table->string('cpf',11)->unique()->nullable(false);
            $table->string('nome',100)->nullable(false);;
            $table->string('celular',11)->nullable(true);
            $table->date('dataNascimento')->nullable(true);
            $table->text('cidade',10000)->nullable(true);
            $table->string('estado',100)->nullable(true);
            $table->string('pais',100)->nullable(true);
            $table->string('rua',100)->nullable(true);
            $table->string('numero',100)->nullable(true);
            $table->string('bairro',100)->nullable(true);
            $table->string('cep',100)->nullable(true);
            $table->string('complemento',100)->nullable(true);
            $table->string('password',100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradors');
    }
};
