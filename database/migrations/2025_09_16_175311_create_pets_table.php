<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('pets', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // FK pro usuário dono
        $table->string('nome');
        $table->string('tipo');
        $table->integer('idade')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}



public function down()
{
    Schema::dropIfExists('pets');
}

};
