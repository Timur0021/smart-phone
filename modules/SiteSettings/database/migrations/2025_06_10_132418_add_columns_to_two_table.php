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
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('show_in_site')->default(false)->after('is_new_window');
            $table->integer('sort_order')->default(100)->after('show_in_site');
        });
        Schema::table('text_in_sites', function (Blueprint $table) {
            $table->boolean('show_in_site')->default(false)->after('is_new_window');
            $table->integer('sort_order')->default(100)->after('show_in_site');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('show_in_site');
            $table->dropColumn('sort_order');
        });
        Schema::table('text_in_sites', function (Blueprint $table) {
            $table->dropColumn('show_in_site');
            $table->dropColumn('sort_order');
        });
    }
};
