<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permissoes;
use App\Models\Cargos;

return new class extends Migration {
    public function up()
    {
        Schema::create('permissoes_cargos', function (Blueprint $table) {
            $table->id();

            // FK para permissoes
            $table->foreignIdFor(Permissoes::class)
                ->constrained('permissoes')
                ->cascadeOnDelete();

            // FK para cargos
            $table->foreignIdFor(Cargos::class)
                ->constrained('cargos')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissoes_cargos');
    }
};
