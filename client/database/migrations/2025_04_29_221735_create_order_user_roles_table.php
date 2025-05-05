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
        Schema::create('order_user_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_order')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_role')->constrained('user_roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_user_roles');
    }
};
