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
        Schema::create('document_biodiversities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_document')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_type')->constrained('document_biodiversity_types')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_biodiversities');
    }
};
