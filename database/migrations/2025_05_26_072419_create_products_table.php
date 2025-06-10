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
            $table->bigIncrements('prod_id'); // Custom primary key
            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->string('fabric_name');
            $table->unsignedBigInteger('brand_id')->nullable(); // FK from brands table
            $table->unsignedBigInteger('category_id')->nullable(); // FK from categories table

            $table->enum('age_group', ['Men', 'Women', 'Baby', 'Boy', 'Girl'])->nullable();
            $table->enum('neck_type', ['Round Neck', 'V-Neck', 'Collar', 'Mandarin Collar', 'High Neck'])->nullable();
            $table->enum('length_type', ['Crop', 'Waist Length', 'Hip Length', 'Thigh Length', 'Knee Length', 'Mid-Calf Length', 'Ankle Length', 'Full Length'])->nullable();
            $table->enum('sleeve_type', ['Full', 'Half', 'Sleeveless'])->nullable();
            $table->enum('fit_type', ['Slim', 'Regular', 'Loose'])->nullable();
            $table->string('care_instructions')->nullable();

            $table->text('prod_description')->nullable();

            $table->string('color')->nullable();
            $table->json('images')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('status')->default(1);
            $table->timestamps(); // created_at and updated_at

            // Add foreign keys if applicable
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('category_id')->references('cat_id')->on('categories')->onDelete('set null');

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
