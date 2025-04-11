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
        Schema::create('document_download_registrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_subscriber')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_document')->nullable()->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('purpose_download'); // mục đích tải
            $table->enum('status', ['pending', 'approve', 'deny'])->default('pending');
            $table->foreignId('id_approver')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('approve_comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_download_registrations');
    }
};
