<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id'); // ID của giỏ hàng
            $table->unsignedBigInteger('document_id'); // ID của sản phẩm
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->timestamps();
            // Thiết lập khóa ngoại
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
