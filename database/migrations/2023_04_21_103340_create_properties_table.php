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
        Schema::create('properties', function (Blueprint $table) {
            $table->string('propertyId')->primary();
            $table->string('name');
            $table->string('location');
            $table->string('isForFemale')->default('false');
            $table->string('distance');
            $table->string('address')->nullable();
            $table->integer('numberOfFloor')->default(0);
            $table->integer('totalRooms');
            $table->integer('totalBedSpaces');
            $table->string('hajjYear');
            $table->string('propertyimg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
