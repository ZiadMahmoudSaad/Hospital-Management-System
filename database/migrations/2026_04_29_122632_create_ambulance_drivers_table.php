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
        Schema::create('ambulance_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_license_number')->unique();
            $table->string('driver_phone');
            $table->foreignId('ambulance_id')->references('id')->on('ambulances')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance_drivers');
    }
};
