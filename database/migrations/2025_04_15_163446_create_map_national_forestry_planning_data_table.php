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
        Schema::create('map_national_forestry_planning_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('tt')->nullable();
            $table->integer('matinh')->nullable();
            $table->integer('tinh')->nullable();
            $table->integer('mahuyen')->nullable();
            $table->integer('huyen')->nullable();
            $table->integer('maxa')->nullable();
            $table->integer('xa')->nullable();
            $table->geometry('geom', '4326');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_national_forestry_planning_data');
    }
};
