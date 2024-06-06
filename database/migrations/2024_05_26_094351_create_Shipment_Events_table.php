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
        Schema::create('Shipment_Events', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_number');
            $table->foreign('shipment_number')->references('shipment_number')->on('Shipment'); // Assuming 'shipments' table exists
            $table->enum('event_type',['pickup_scheduled','awaiting_pickup','lost','pickup', 'in_transit', 'delivered'])->nullable();
            // e.g., 'pickup_scheduled','awaiting_pickup','lost','pickup', 'in_transit', 'delivered'

            // Consider timestamps for individual events
            $table->timestamp('event_time');

            $table->string('location'); // Optional: Specify location details if needed

            $table->text('details'); // Provide a more detailed description of the event

            $table->timestamps(); // Records creation and update timestamps for the event itself
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Shipment_Events');
    }
};
