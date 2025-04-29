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
        Schema::create('document_legals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('id_document')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_type')->constrained('document_legal_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('doc_number'); // số hiệu
            $table->enum('validity', ['active', 'expired', 'upcoming', 'undefined']); // hiệu lực
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_legals');
    }
};
