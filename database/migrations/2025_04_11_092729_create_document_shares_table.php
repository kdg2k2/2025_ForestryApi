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
        Schema::create('document_shares', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->foreignId('id_unit')->nullable()->constrained('user_units')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('document_shares');
    }
};
