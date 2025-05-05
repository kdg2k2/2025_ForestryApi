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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name_en')->unique();
            $table->string('name_vn')->unique();
            $table->integer('price')->default(0);
            $table->integer('download_limit_per_month')->nullable()->default(3); // null thì ko giới hạn
            $table->integer('view_limit_per_month')->nullable()->default(3); // null thì ko giới hạn
            $table->integer('page_view_limit')->nullable()->default(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
