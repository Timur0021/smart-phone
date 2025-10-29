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
            $table->boolean('is_new_window')->default(false)->after('to_front');
        });

        Schema::table('text_in_sites', function (Blueprint $table) {
            $table->boolean('is_new_window')->default(false)->after('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('is_new_window');
        });

        Schema::table('text_in_sites', function (Blueprint $table) {
            $table->dropColumn('is_new_window');
        });
    }
};
