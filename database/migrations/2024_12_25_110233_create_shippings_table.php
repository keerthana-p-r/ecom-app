<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id('shipping_id'); // Primary Key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Foreign Key to Orders
            $table->text('shipping_address'); // Shipping address
            $table->string('tracking_number')->nullable(); // Tracking number (nullable if not available yet)
            $table->enum('shipping_status', ['dispatched', 'in_transit', 'delivered', 'returned'])->default('dispatched'); // Shipping status
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
};
