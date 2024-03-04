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
        Schema::create('rooms', function (Blueprint $table) {
          
            $table->string('roomId');
            $table->string('propertyId');
            // $table->foreign('propertyId')->references('propertyId')->on('properties');
             $table->primary(['roomId', 'propertyId']);
            $table->integer('floorNumber')->nullable();
            $table->string('isFull');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
