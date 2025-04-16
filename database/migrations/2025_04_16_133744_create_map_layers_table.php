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
        Schema::create('map_layers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_layer_type')->constrained('map_layer_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name_region_col');
            $table->integer('year');
            $table->boolean('multi_province')->default(false); // thuộc nhiều tỉnh
            $table->integer('province_code');
            $table->string('link_root');
            $table->string('layers');
            $table->string('version');
            $table->string('cql_filter');
            $table->string('styles');
            $table->string('src');
            $table->string('format');
            $table->string('name_province_code_col');
            $table->string('name_district_code_col');
            $table->string('name_commune_code_col');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_layers');
    }
};
