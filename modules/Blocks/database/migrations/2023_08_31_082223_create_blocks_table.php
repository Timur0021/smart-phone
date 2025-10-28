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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->json('content')->nullable();
            $table->integer('template_block_id')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->default(true);
            $table->string('model')->nullable();
            $table->integer('count')->nullable();
            $table->boolean('with_additional_query')->default(false);
            $table->boolean('get_all')->default(false);
            $table->boolean('with_table')->default(false);
            $table->longText('table')->nullable();

            $table->timestamps();
        });
        Schema::create('template_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->json('content');
            $table->string('type')->nullable();
            $table->boolean('status')->default(true);
            $table->string('model')->nullable();
            $table->integer('count')->nullable();
            $table->boolean('with_additional_query')->default(false);
            $table->boolean('get_all')->default(false);
            $table->boolean('with_table')->default(false);
            $table->longText('table')->nullable();
            $table->timestamps();
        });
        Schema::create('page_block', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('template_blocks');
        Schema::dropIfExists('page_block');
        Schema::dropIfExists('block_types');

    }
};
