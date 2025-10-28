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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(true);
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->nestedSet();
            $table->integer('order')->nullable();

            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('page_categories', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('slug');
            $table->boolean('status')->default(true);

            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();

            $table->nestedSet();

            $table->integer('order')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_categories');

    }
};
