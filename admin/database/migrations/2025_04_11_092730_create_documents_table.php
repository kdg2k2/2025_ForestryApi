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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('id_document_type')->constrained('document_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name', 500);
            $table->date('issued_date')->nullable(); // ngày ban hành
            $table->string('author')->nullable();
            $table->text('path');
            $table->boolean('allow_download')->default(true);
            $table->foreignId('id_uploader')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_share')->nullable()->constrained('document_shares')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('price')->default(10000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
