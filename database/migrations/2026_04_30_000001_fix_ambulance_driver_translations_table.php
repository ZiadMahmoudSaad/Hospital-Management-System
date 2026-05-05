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
        // Drop the incomplete table
        Schema::dropIfExists('ambulance_driver_translations');

        // Create the proper translations table
        Schema::create('ambulance_driver_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['ambulance_driver_id', 'locale']);
            $table->foreignId('ambulance_driver_id')->references('id')->on('ambulance_drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance_driver_translations');
    }
};
