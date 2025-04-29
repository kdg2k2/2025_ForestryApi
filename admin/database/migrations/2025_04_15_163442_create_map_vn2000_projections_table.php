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
        // bảng chuyển đổi hệ chiếu vn2000
        Schema::create('map_vn2000_projections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('province');
            $table->string('zone');
            $table->integer('epsg_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_vn2000_projections');
    }
};
