<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     Schema::create('pet_vacinas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
    $table->foreignId('vacina_id')->constrained('vacinas')->onDelete('cascade');
    $table->date('data_aplicacao');
    $table->date('data_proxima_dose')->nullable();
    $table->timestamps();
});


    }

    public function down(): void
    {
        Schema::dropIfExists('pet_vacinas'); // <- Corrigido aqui
    }
};
