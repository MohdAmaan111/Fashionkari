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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('prod_id');      // product_id
            $table->string('prod_name');
            $table->string('prod_slug')->unique();
            $table->unsignedBigInteger('cat_id');
            $table->decimal('mrp', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->text('images');
            $table->integer('stock');
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->boolean('status')->default(1); // 1=active, 0=inactive
            $table->timestamps();

            //If a category is deleted, all products with that cat_id will also be deleted automatically
            // $table->foreign('cat_id')->references('cat_id')->on('categories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
