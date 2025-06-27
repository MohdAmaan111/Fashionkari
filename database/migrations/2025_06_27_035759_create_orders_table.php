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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('customer_id');

            // Order Info
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method'); // COD, UPI, etc.
            $table->string('payment_status')->default('pending');
            $table->string('order_status')->default('pending');
            $table->text('note')->nullable();

            // Shipping
            $table->string('shipping_method')->nullable(); // ✅ New column
            $table->string('name');
            $table->string('phone');
            $table->string('pincode');
            $table->string('state');
            $table->string('city');
            $table->string('area')->nullable();
            $table->text('address_line');

            $table->timestamps();

            $table->foreign('customer_id')->references('cus_id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
