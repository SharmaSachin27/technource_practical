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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->enum('booking_type', ['Full Day', 'Half Day']);
            $table->date('booking_date');
            $table->enum('booking_slot', ['Morning', 'Evening']);
            $table->time('booking_time');   
            $table->unique(['booking_date', 'booking_slot']); // Unique constraint to prevent duplicate bookings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
