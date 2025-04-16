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
        // đặt câu hỏi cho chuyên gia đa dạng sinh học
        Schema::create('bio_expert_asks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->double('x');
            $table->double('y');
            $table->text('question'); // mô tả loài
            $table->text('location_description')->nullable(); // mô tả vị trí
            $table->foreignId('id_unit')->constrained('user_units')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_expert')->constrained('bio_experts')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_expert_asks');
    }
};
