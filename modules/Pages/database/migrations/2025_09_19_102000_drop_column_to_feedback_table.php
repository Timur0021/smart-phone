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
        Schema::table('feedback', function (Blueprint $table) {
            if (Schema::hasColumn('feedback', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('feedback', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('feedback', 'i_agree')) {
                $table->dropColumn('i_agree');
            }
        });

        Schema::table('feedback', function (Blueprint $table) {
            if (!Schema::hasColumn('feedback', 'mark')) {
                $table->float('mark')->nullable()->after('sort_order');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->after('phone');
            $table->boolean('i_agree')->default(false)->after('status');
        });
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn('mark');
        });
    }
};
