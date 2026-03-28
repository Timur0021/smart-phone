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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('show_in_filter')->default(false);
            $table->boolean('show_in_product')->default(false);
            $table->timestamps();
        });

        Schema::create('category_characteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('characteristic_id')->index();
            $table->unsignedBigInteger('category_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
        Schema::dropIfExists('category_characteristics');
    }
};
