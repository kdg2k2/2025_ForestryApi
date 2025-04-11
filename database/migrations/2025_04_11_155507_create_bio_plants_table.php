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
        Schema::create('bio_plants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("nganhlatin")->nullable();
            $table->text("nganhtv")->nullable();
            $table->text("manganh")->nullable();
            $table->text("loplatin")->nullable();
            $table->text("loptv")->nullable();
            $table->text("malop")->nullable();
            $table->text("bolatin")->nullable();
            $table->text("botv")->nullable();
            $table->text("mabo")->nullable();
            $table->text("holatin")->nullable();
            $table->text("hotv")->nullable();
            $table->text("maho")->nullable();
            $table->text("chilatin")->nullable();
            $table->text("chitv")->nullable();
            $table->text("machi")->nullable();
            $table->text("danhphap2phan")->nullable();
            $table->text("loailatin")->nullable();
            $table->text("tentacgia")->nullable();
            $table->text("loaitv")->nullable();
            $table->text("maloai")->nullable();
            $table->text("than_canh")->nullable();
            $table->text("la")->nullable();
            $table->text("pbo_vietnam")->nullable();
            $table->text("hoa_qua")->nullable();
            $table->text("sinhthai")->nullable();
            $table->text("pbo_thegioi")->nullable();
            $table->text("daicao")->nullable();
            $table->text("dachuu")->nullable();
            $table->text("giatri")->nullable();
            $table->text("sachdovn")->nullable();
            $table->text("iucn")->nullable();
            $table->text("nd84")->nullable();
            $table->text("nguon")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_plants');
    }
};
