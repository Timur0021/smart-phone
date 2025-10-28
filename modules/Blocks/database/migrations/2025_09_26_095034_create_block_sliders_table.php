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
        Schema::create('block_sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_id')->nullable()->index();
            $table->unsignedBigInteger('slider_id')->nullable()->index();
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_sliders');
    }
};
