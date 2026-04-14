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
        Schema::create('np_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('CityRef');
            $table->string('Ref');
            $table->string('Description');
            $table->string('CityDescription');
            $table->string('TypeOfWarehouse')->nullable();
            $table->string('ShortAddress');
            $table->float('Longitude', 18, 15);
            $table->float('Latitude', 18, 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('np_warehouses');
    }
};
