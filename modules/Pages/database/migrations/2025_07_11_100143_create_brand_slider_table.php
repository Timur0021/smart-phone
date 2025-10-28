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
        Schema::create('brand_slider', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->index();
            $table->unsignedBigInteger('slider_id')->index();
            $table->smallInteger('sort_order')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_slider');
    }
};
