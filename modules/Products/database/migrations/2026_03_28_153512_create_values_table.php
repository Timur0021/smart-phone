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
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->smallInteger('sort_order')->default(0);
            $table->unsignedBigInteger('characteristic_id')->nullable()->index();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('product_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('value_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('values');
        Schema::dropIfExists('product_value');
    }
};
