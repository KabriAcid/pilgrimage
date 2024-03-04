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
        Schema::create('alhajis', function (Blueprint $table) {
            $table->string('alhajiId')->primary();
            $table->string('fullName');
            $table->string('passportNo');
            $table->string('healthStatus');
            $table->string('lga');
            $table->string('town');
            $table->string('gender');
            $table->string('hajjYear');
            $table->string('airLifted');
            $table->string('accomodated');
            $table->string('isOfficial');
            $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    /**lar
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alhajis');
    }
};
