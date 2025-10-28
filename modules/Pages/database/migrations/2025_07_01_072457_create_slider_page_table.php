<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Pages\Models\Page;
use Modules\Pages\Models\Slider;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_slider', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class);
            $table->foreignIdFor(Slider::class);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_slider');
    }
};
