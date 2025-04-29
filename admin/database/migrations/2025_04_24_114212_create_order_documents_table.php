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
        Schema::create('order_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_order')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_document')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('price');
            $table->integer('quantity')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_documents');
    }
};
