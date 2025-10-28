<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Pages\Models\Page;
use Modules\Pages\Models\Sidebar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order')->nullable();
            $table->nestedSet();
            $table->integer('page_id')->nullable();
            $table->timestamps();
        });

        Schema::create('sidebar_to_page', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidebar_id');
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
        Schema::dropIfExists('sidebars');
        Schema::dropIfExists('sidebar_to_page');
    }
};
