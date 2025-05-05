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
        // chứa ảnh của các câu hỏi cho chuyên gia đa dạng sinh học
        Schema::create('bio_expert_ask_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_ask')->constrained('bio_expert_asks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_expert_ask_images');
    }
};
