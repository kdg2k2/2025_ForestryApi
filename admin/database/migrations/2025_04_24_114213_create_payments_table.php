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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_order')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('vnp_TxnRef')->unique();
            $table->integer('vnp_Amount');
            $table->string('vnp_ResponseCode')->nullable();
            $table->string('vnp_TransactionNo')->nullable();
            $table->string('vnp_BankCode')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
