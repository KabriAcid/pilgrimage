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

        Schema::create('bed_spaces', function (Blueprint $table) {

            $table->string('spaceId');
            $table->string('roomId');
            $table->string('propertyId');
            $table->primary(['spaceId', 'roomId', 'propertyId']);
            //$table->foreign('roomId')->references('roomId')->on('rooms');
           // $table->foreign('propertyId')->references('propertyId')->on('rooms');
            $table->string('isAllocated');
            $table->string('alhajiId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_spaces');
    }
};
