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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Foreign Key to Orders
            $table->string('payment_method'); //  credit card, PayPal, COD
            $table->string('transaction_id')->unique(); // Unique Transaction ID for the payment
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending'); // Payment Status
            $table->timestamp('payment_date'); 
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
        Schema::dropIfExists('payments');
    }
};
