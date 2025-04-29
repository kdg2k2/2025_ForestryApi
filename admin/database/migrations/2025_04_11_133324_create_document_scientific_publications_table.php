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
        Schema::create('document_scientific_publications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('id_document')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_type')->constrained('document_scientific_publication_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('co_author')->nullable(); // đồng tác giả
            $table->integer('year');
            $table->string('edition')->nullable(); // số xuất bản
            $table->string('accompanying_documents')->nullable(); // tài liệu kèm theo
            $table->string('linkyoutube')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_scientific_publications');
    }
};
