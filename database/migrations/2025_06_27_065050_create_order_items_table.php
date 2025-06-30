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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id'); // Auto-incrementing primary key

            $table->string('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id');

            $table->string('size');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('order_number')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('prod_id')->on('products')->onDelete('cascade');
            $table->foreign('variant_id')->references('variant_id')->on('variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
