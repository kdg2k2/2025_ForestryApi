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
        Schema::create('bio_animal_national_parks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("id_nationpark")->constrained("bio_national_parks")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("id_animal")->constrained("bio_animals")->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_animal_national_parks');
    }
};
