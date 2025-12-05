<?php

use App\Models\Permissoes;
use App\Models\Cargos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permissoes_cargos', function (Blueprint $table) {
            $table->foreignIdFor(Permissoes::class);
            $table->foreignIdFor(Cargos::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes');
    }
};
