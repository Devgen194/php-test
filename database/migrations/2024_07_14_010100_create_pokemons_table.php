<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration

{

    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('url');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
