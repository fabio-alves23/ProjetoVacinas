<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cargos_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('cargo_id')->constrained('cargos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cargos_user');
    }
};
