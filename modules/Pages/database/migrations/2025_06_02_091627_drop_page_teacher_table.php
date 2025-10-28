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
        Schema::dropIfExists('page_teacher');
        Schema::dropIfExists('teachers');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('page_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('teacher_id');
            $table->smallInteger('sort_order')->default(100);
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->text('full_name');
            $table->string('average_score')->nullable();
            $table->string('experience')->nullable();
            $table->text('education')->nullable();
            $table->text('additional_information')->nullable();
            $table->timestamps();
        });
    }
};
