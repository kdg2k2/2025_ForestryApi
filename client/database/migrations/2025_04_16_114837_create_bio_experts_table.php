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
        // chuyên gia đa dạng sinh học
        Schema::create('bio_experts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->foreignId('id_unit')->nullable()->constrained('user_units')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('specialize')->nullable();
            $table->string('path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_experts');
    }
};
