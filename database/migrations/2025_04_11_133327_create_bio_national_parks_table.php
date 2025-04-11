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
        Schema::create('bio_national_parks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("name")->nullable();
            $table->text("logo")->nullable();
            $table->text("introImg")->nullable();
            $table->text("fb")->nullable();
            $table->text("homepage")->nullable();
            $table->text("intro")->nullable();
            $table->text("location")->nullable();
            $table->text("hisGeo")->nullable();
            $table->text("biodiversity")->nullable();
            $table->text("slug")->nullable();
            $table->double("x")->nullable();
            $table->double("y")->nullable();
            $table->foreignId("id_type")->constrained('bio_national_park_types')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_national_parks');
    }
};
