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
        Schema::create('vehicle_crash_events_connector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('crash_event_id');
            $table->timestamps();

            $table->unique(['vehicle_id', 'crash_event_id']);
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');  
            $table->foreign('crash_event_id')->references('id')->on('crash_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_crash_events_connector');
    }
};
