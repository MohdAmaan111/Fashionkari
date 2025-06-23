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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('wish_id'); // Custom primary key
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('cus_id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('prod_id')->on('products')->onDelete('cascade');
            $table->foreign('variant_id')->references('variant_id')->on('variants')->onDelete('cascade');

            $table->unique(['customer_id', 'variant_id']); // Prevent duplicates of same variant
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
