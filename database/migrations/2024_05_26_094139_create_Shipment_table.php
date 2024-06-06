<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Shipment', function (Blueprint $table) {
            $table->string('shipment_number')->primary();
            $table->date('date'); // Assuming consistent date format
            $table->string('item_type'); // Foreign key to a separate table (optional)
            $table->integer('quantity');
            $table->decimal('weight', 8, 2);
            $table->decimal('cubic_meters', 8, 2);

            // Foreign keys for sender and recipient
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('Customer');
            $table->unsignedBigInteger('recipient_id');
            $table->foreign('recipient_id')->references('id')->on('Customer');

            $table->string('origin_location');
            $table->string('destination_location');

            $table->string('shipping_cost')->nullable(); // Consider decimal if needed for calculations
            $table->string('other_costs')->nullable(); // Consider decimal if needed for calculations
            $table->string('total_cost')->nullable(); // Consider decimal if needed for calculations
            $table->enum('status',['ON-GOING', 'DELIVERED', 'PENDING']);
            $table->timestamps(); // Records creation and update timestamps for the event itself
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Shipment');
    }
};
