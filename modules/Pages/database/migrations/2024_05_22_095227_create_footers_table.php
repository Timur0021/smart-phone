<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Pages\Models\Footer;
use Modules\Pages\Models\Page;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('header')->default(false);
            $table->integer('order')->nullable();
            $table->nestedSet();
            $table->integer('page_id')->nullable();
            $table->timestamps();
        });

        Schema::create('footer_to_page', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footer_id');
            $table->unsignedBigInteger('page_id');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
        Schema::dropIfExists('footer_to_page');
    }
};
